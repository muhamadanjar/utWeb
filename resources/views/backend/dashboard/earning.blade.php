@extends($ctemplates.'.main')
@section('content-admin')
<div class="box">
    <div class="page-contant-inner">
        <div class="box-header">
            <h4 class="box-title">My Earnings</h4>
        </div>
        
        <form name="frmreview" id="frmreview" method="post" action="">
            <input type="hidden" name="paidStatus" value="" id="paidStatus">
            <input type="hidden" name="action" value="" id="action">
            <input type="hidden" name="iRatingId" value="" id="iRatingId">
        </form>
        
        <div class="box-body">
            <div class="payment-tabs">
                
            </div>
            <div class="trips-table-inner">
                <div class="driver-trip-table">
                      <form  name="frmbooking" id="frmbooking" method="post" action="payment_request_a.php">
                        <input type="hidden" id="type" name="type" value="Available">
                        <input type="hidden" id="action" name="action" value="send_equest">
                        <input type="hidden"  name="eTransRequest" id="eTransRequest" value="">
                        <input type="hidden"  name="iBookingId" id="iBookingId" value="">
                        <input type="hidden"  name="vHolderName1" id="vHolderName1" value="">
                        <input type="hidden"  name="vBankName1" id="vBankName1" value="">
                        <input type="hidden"  name="iBankAccountNo1" id="iBankAccountNo1" value="">
                        <input type="hidden"  name="BICSWIFTCode1" id="BICSWIFTCode1" value="">
                        <input type="hidden"  name="vBankBranch1" id="vBankBranch1" value="">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" id="dataTables-example" >
                              <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Booking Date</th>
                                    <th>Fare</th>
                                    <th>Commission</th>
                                    <th>Booking Charge</th>
                                    <th>Tip</th>
                                    <th>Payment</th>
                                    <th>Payment type</th>
                                    <th>Invoice</th>
                                    <th>Request Payment For</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeA">
                                            <td>25963793</td>
                                            <td>28th March, 2019</td>
                                            <td align="right">$3.00</td>
                                            <td align="right">$0.30</td>
                                                                                                <td align="right">$0.00</td>
                                                                                                                                                    <td align="right">-</td>
                                                                                                <td align="right">$2.70</td>
                                            <td>Cash</td>
                                            <td class="center">
                                                                                                            <a target = "_blank" href="invoice.php?iTripId=TVRFM01BPT0="><img src="assets/img/driver-view-icon.png"></a>
                                                                                                    </td>
                                            <td>
                                                <div class="checkbox-n">
                                                                                                    </td>
                                        </tr>
                                                                            
                                    </tbody>
                            <tfoot>
                                <tr class="last_row_record">
                                    <td></td>
                                    <td></td>
                                    <td class="last_record_row">$ 210269.13</td>
                                    <td class="last_record_row midddle_rw">$ 52509.94</td>
                                    <td class="last_record_row midddle_rw">$ 0.00</td>
                                    <td class="last_record_row midddle_rw">$ 0.00</td>										<td class="last_record_row"> $157759.19</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        
                      </form>
                  </div>
                </div>
            </div>
      <div style="clear:both;"></div>
    </div>
</div>    
@endsection
