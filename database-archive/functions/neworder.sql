SET ANSI_NULLS OFF
GO
SET QUOTED_IDENTIFIER OFF
GO

ALTER PROCEDURE [dbo].[ReserveNextOrderID]
 @Initials CHAR(3),
 @Order_ID CHAR(20) OUTPUT
AS

declare @TheOrder_ID table (Order_ID varchar(20));

with
-- This will return the 2-digit current year as a string
YearDigits as (
select right('00'+cast(datepart(year,current_timestamp) % 100 as char(2)), 2) as YearDigits
)
,

-- This will return the components of the latest Order_ID
LatestID as (
select
 max(yr.YearDigits) as YearDigits,
 substring(max(res.Order_ID),3,1) as CompanyLetter,
 substring(max(res.Order_ID),4,1) as CurrentLetter,
 substring(max(res.Order_ID),5,5) as CurrentNumber
from yearDigits yr
cross join (
 select Order_ID from OrderIDReservations cross join YearDigits yr cross join (select Letter from OrderCompanyLetterAbbreviations where Company='DOOR') ltr where Order_ID like yr.YearDigits + ltr.Letter + '%'
 union all
 select '00' + ltr.Letter + 'A00000' -- in case OrderReservations is empty
 from OrderCompanyLetterAbbreviations ltr
 where Company='DOOR'
) res
)

-- This will increment the latest Order_ID, store the reservation, and save the Order_ID into a table variable so we can return it
insert into OrderIDReservations (Order_ID, ReservedBy, WhenReserved)
output inserted.Order_ID into @TheOrder_ID
select
 lid.YearDigits +
 lid.CompanyLetter +
 case
   when lid.CurrentNumber >= '99999' then char(ascii(lid.CurrentLetter) +  -- We execute this when we need to roll over to the next letter
      case
        when CurrentLetter in ('H','N','P') then 2  -- Want to skip I, O, and Q because they look like numbers
        when CurrentLetter = 'Z' then -25  -- Want to go from Z back to A (should not happen)
        else 1  -- Normally we just use the next letter in the alphabet
      end)
    else lid.CurrentLetter -- If we have not hit 99999 then keep using the same letter
 end +
 right('00000'+cast(cast(lid.CurrentNumber as int)+1 as varchar(12)),5),  -- This increments the number, rolling over form 99999 to 00000
 @Initials,
 current_timestamp

from LatestID lid
;

select @Order_ID=max(Order_ID) from @TheOrder_ID;
