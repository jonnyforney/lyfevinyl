CREATE OR REPLACE FUNCTION reserve_next_order_id(init CHAR(10))
  RETURNS CHAR(10) AS $$

  DECLARE TheOrder_ID CHAR(9);
  BEGIN


    WITH YearDigits AS (
      SELECT right(cast(EXTRACT(YEAR FROM current_timestamp) AS char(4)), 2) AS YearDigits
    ),
    LatestID AS (
    SELECT max(yr.YearDigits) AS YearDigits,
      substring(max(res.order_id),3,1) AS CompanyLetter,
      substring(max(res.order_id),4,1) AS CurrentLetter,
      substring(max(res.order_id),5,5) AS CurrentNumber
    FROM YearDigits yr
    CROSS JOIN (
      SELECT order_id FROM order_id_reservations
      CROSS JOIN YearDigits yr
      WHERE order_id LIKE CONCAT(yr.YearDigits,'%')

      UNION ALL

      SELECT '00AA00000' -- in case order_id_reservations is empty
    ) res
    )

    INSERT INTO order_id_reservations (order_id, reserved_by, created_at, updated_at)
    SELECT CONCAT(lid.YearDigits,
      CASE WHEN lid.CurrentLetter = 'Z' AND lid.CurrentNumber >= '99999' THEN
        chr(
            ASCII(lid.CompanyLetter) +
          -- We execute this when we need to roll over to the next letter
          CASE
            WHEN CompanyLetter IN ('H','N','P') THEN 2  -- Want to skip I, O, and Q because they look like numbers
            WHEN CompanyLetter = 'Z' THEN -25  -- Want to go from Z back to A (should not happen)
            ELSE 1  -- Normally we just use the next letter in the alphabet
          END
        )
        ELSE lid.CompanyLetter
      END, -- If we have not hit 99999 then keep using the same letter
      CASE WHEN lid.CurrentNumber >= '99999' THEN
          chr(
            ASCII(lid.CurrentLetter) +
            -- We execute this when we need to roll over to the next letter
            CASE
              WHEN CurrentLetter IN ('H','N','P') THEN 2  -- Want to skip I, O, and Q because they look like numbers
              WHEN CurrentLetter = 'Z' THEN -25  -- Want to go from Z back to A (should not happen)
            ELSE 1  -- Normally we just use the next letter in the alphabet
            END
          )
        ELSE lid.CurrentLetter -- If we have not hit 99999 then keep using the same letter
      END,
      substring(
           CONCAT('00000',
              cast(cast(lid.CurrentNumber AS int)+1 AS varchar(12))
           )
          FROM
          character_length(
              CONCAT('00000',
                  cast(cast(lid.CurrentNumber AS int)+1 AS varchar(12))
              )
          ) - 4
      )
    ) AS order_id  -- This increments the number, rolling over form 99999 to 00000
     ,init AS reserved_by
     ,CURRENT_TIMESTAMP AS created_at
     ,CURRENT_TIMESTAMP AS updated_at
    FROM LatestID lid


     RETURNING order_id INTO TheOrder_ID;

    RETURN TheOrder_ID;
  END;
$$ LANGUAGE plpgsql;
