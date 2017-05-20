CREATE OR REPLACE FUNCTION reserve_next_customer_id(init CHAR(10))
  RETURNS CHAR(10) AS $$

  DECLARE TheCustomer_ID CHAR(10);
  BEGIN

    WITH YearDigits AS (
      SELECT right(cast(EXTRACT(YEAR FROM current_timestamp) AS char(4)), 2) AS YearDigits
    ),
    LatestID AS (
    SELECT max(yr.YearDigits) AS YearDigits,
      substring(max(res.customer_id),3,8) AS CurrentNumber
    FROM YearDigits yr
    CROSS JOIN (
      SELECT customer_id FROM customer_id_reservations
      CROSS JOIN YearDigits yr
      WHERE customer_id LIKE CONCAT(yr.YearDigits,'%')

      UNION ALL

      SELECT '0000000000' -- in case customer_id_reservations is empty
    ) res
    )

    INSERT INTO customer_id_reservations (customer_id, reserved_by, created_at, updated_at)
    SELECT CONCAT(lid.YearDigits,
            substring(
               CONCAT(
                   '00000000',
                    cast(
                        cast(lid.CurrentNumber AS int)+1 AS varchar(12)
                    )
               )
          ,
          character_length(
              CONCAT('00000000',
                  cast(cast(lid.CurrentNumber AS int)+1 AS varchar(12))
              )
          ) - 7
      )
    ) AS customer_id  -- This increments the number, rolling over from 99999 to 00000
     ,init AS reserved_by
     ,CURRENT_TIMESTAMP AS created_at
     ,CURRENT_TIMESTAMP AS updated_at
    FROM LatestID lid


     RETURNING customer_id INTO TheCustomer_ID;

    RETURN TheCustomer_ID;
  END;
$$ LANGUAGE plpgsql;