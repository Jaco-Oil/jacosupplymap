-- for stations
-- create stations_tmp table and import new data

-- update

update stations s
inner join stations_tmp st on s.inner_id = st.stationID
set s.name = st.StationName,
s.address = st.StationAddress,
s.city = st.StationCity,
s.state = st.StationState,
s.zip_code = st.StationZipCode,
s.ownership_name = st.ownershipName,
s.operator = st.StationOperator,
s.email = st.StationEmail,
s.phone = st.StationPhone,
s.mobile = st.StationMobile,
s.supervisor_name = st.SupervisorName,
s.partnership = st.Partnership,
s.sms_email = st.SMSEmail,
s.sms_email2 = st.SMSEmail2,
s.sms_email3 = st.SMSEmail3


-- for best_buy
-- create best_buy_tmp table and import new data

drop best_buy;

insert into best_buy (
station_inner_id,
name,
rank_id,
terminal_inner_id,
alternate_terminal_name,
supplier_id,
alternate_supplier_name,
carrier_id,
effective_price,
supplier_discount,
supplier_ec,
net_cost,
carrier_gas_freight,
effective_date,
effective_time,
carrier_alternate_name,
direct_link,
fuel_tax,
product_grade_name,
product_grade_id,
grade_enforced,
epa_schedule_name,
epa_date_begin,
epa_date_end,
epa_district_name,
product_order,
product_code,
product_alternate_name,
carrier_surcharge_amt,
ust_fee
)
select

stationID,
name,
rankID,
terminalID,
AlternateTerminalName,
supplierID,
AlternateSupplierName,
carrierID,
effectivePrice,
supplierDiscount,
supplierEC,
netCost,
carrierGasFreight,
effectiveDate,
effectiveTime,
carrierAlternateName,
directLink,
fuelTax,
productGradeName,
productGradeID,
gradeEnforced,
epaScheduleName,
epaDateBegin,
epaDateEnd,
epaDistrictName,
productOrder,
ProductCode,
productAlternateName,
carrierSurchargeAmt,
ustFee

from best_buy_tmp
