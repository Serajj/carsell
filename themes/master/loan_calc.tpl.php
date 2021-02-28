<?php
  /**
   * Loan Calculator
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: loan_calc.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo tertiary segment">
<a id="tglcal" class="push-right"><i class="icon arrow down"></i></a>
  <h4 class="header">Loan Calculator</h4>
  <div class="wojo fitted divider"></div>
  <form action="" method="post" class="wojo small form" name="loan_calc" id="loan_calc">
    <div class="field">
      <label>Car Loan Amount</label>
      <div class="wojo small action input">
        <input name="LoanAmount" id="LoanAmount" type="text" value="3000">
        <div class="wojo button"><?php echo $core->cur_symbol;?></div>
      </div>
    </div>
    <div class="field">
      <label>Annual Interest Rate</label>
      <div class="wojo small action input">
        <input name="InterestRate" id="InterestRate" type="text" value="7.0">
        <div class="wojo button">%</div>
      </div>
    </div>
    <div class="field">
      <label>Term of Car Loan</label>
      <div class="wojo small action input">
        <input name="NumberOfYears" id="NumberOfYears" type="text" value="4">
        <div class="wojo small button">years</div>
      </div>
    </div>
    <div class="clearfix">
      <button name="calculate" class="wojo small purple button push-right">Calculate</button>
    </div>
    <div class="wojo fitted divider"></div>
    <div class="field">
      <label>Number of Car Payments</label>
      <input readonly="readonly" type="text" id="NumberOfPayments" name="NumberOfPayments">
    </div>
    <div class="field">
      <label>Monthly Payment</label>
      <div class="wojo small action input">
        <input readonly="readonly" type="text" id="MonthlyPayment" name="MonthlyPayment">
        <div class="wojo button"><?php echo $core->cur_symbol;?></div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    var loan_calc_obj = function () {
        var self = {
            form: $('#loan_calc'),
            calculate: function () {
                var DownPayment = "0";
                self.get_amount();
                self.get_annual_rate();
                self.get_years();
                var MonthRate = AnnualRate / 12;
                var NumPayments = Years * 12;
                var Prin = LoanAmount - DownPayment;
                var MonthPayment = Math.floor((Prin * MonthRate) / (1 - Math.pow((1 + MonthRate), (-1 * NumPayments))) * 100) / 100;
                self.update_number_payments(NumPayments);
                self.update_monthly_payment(MonthPayment);
            },
            init: function () {
                self.calculate();
                $("[name=calculate]", self.form).on("click", function (e) {
                    self.calculate();
                    e.preventDefault();
                })
				$("#tglcal").on("click", function () {
					$(self.form).slideToggle();
				})
				
            },
            get_amount: function () {
                return LoanAmount = $('[name=LoanAmount]', self.form).val();
            },
            get_annual_rate: function () {
                return AnnualRate = $('[name=InterestRate]', self.form).val() / 100;
            },
            get_years: function () {
                return Years = $('[name=NumberOfYears]', self.form).val();
            },
            update_number_payments: function (NumPayments) {
                return self.form.find('[name=NumberOfPayments]').val(NumPayments);
            },
            update_monthly_payment: function (MonthPayment) {
                return self.form.find('[name=MonthlyPayment]').val(MonthPayment);
            }
        }
        return self;
    }
    var loan_calc = new loan_calc_obj();
    loan_calc.init();
});
// ]]>
</script> 