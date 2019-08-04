@extends($ctemplates.'.main')
@section('breadcrumb')

	<li><a href="#"><i class="fa fa-dashboard"></i> Utama</a></li>
	<li class="active">My Wallet</li>

@endsection
@section('content-admin')
<div class="box box-default">
    <div class="page-contant-inner">
        <h4 class="box-title">My Wallet</h4>
        <!-- trips page -->
        <div class="trips-page wallet-page">
            <form name="search" action="" method="post" onSubmit="return checkvalid()">
                <input type="hidden" name="action" value="search" />
                <div class="Posted-date">
                    <h5>Search By Date</h5>
                    <span>
                        <input type="text" id="dp4" name="startDate" placeholder="From Date" class="form-control" value=""/>
                        <input type="text" id="dp5" name="endDate" placeholder="To Date" class="form-control" value=""/>
                    </span>
                </div>
                <div class="time-period">
                    <h5>Search By Date</h5>
                    <span>
                        <a onClick="return todayDate('dp4', 'dp5');">Today</a>
                        <a onClick="return yesterdayDate('dFDate', 'dTDate');">Yesterday</a>
                        <a onClick="return currentweekDate('dFDate', 'dTDate');">Current Week</a>
                        <a onClick="return previousweekDate('dFDate', 'dTDate');">Previous Week</a>
                        <a onClick="return currentmonthDate('dFDate', 'dTDate');">Current Month</a>
                        <a onClick="return previousmonthDate('dFDate', 'dTDate');">Previous Month</a>
                        <a onClick="return currentyearDate('dFDate', 'dTDate');">Current Year</a>
                        <a onClick="return previousyearDate('dFDate', 'dTDate');">Previous Year</a>
                    </span> 
                    <b><button class="driver-trip-btn">Search</button><button onClick="reset();" class="driver-trip-btn">Reset</button></b>
                </div>
            </form>
            <div class="box-body"> 

                <div class="trips-table-inner">
                    <div class="driver-trip-table">
                        <table width="100%" border="0" cellpadding="0" cellspacing="1" id="table_wallet" class="display table table-bordered" >
                            <thead>
                                <tr>
                                    <th width="20%">Description</th>
                                    <th width="15%">Amount</th>
                                    
                                    <th width="10%">Balance For</th>
                                    <th width="15%">Transaction Date</th>
                                    <th width="20%">Type</th>
                                    <th width="10%">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    
                            </tbody>
                            
                            
                        </table>
                    </div>
                </div>			   
            </div>
            <div class="btn-group">
                <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#uiModal">Withdraw Request</a>&nbsp;&nbsp;&nbsp;



            </div>

            
        </div>
        
        <div style="clear:both;"></div>
    </div>
</div>
@endsection

@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('/plugins/datatables/datatables.min.css')}}">
@endsection
@section('script-end')
    @parent
    <script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('/plugins/jquery-ui/jquery-ui.js')}}"></script>
    <script type="text/javascript" src="{{ url('/plugins/bootbox/bootbox.js') }}"></script>

    <script type="text/javascript" src="{{ url('js/rm.js')}}"></script>
    <script>
    $(function(){

        
        $("#dp4").datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true,
            changeMonth: true,
            yearRange: "-100:+10"
        });
        $("#dp5").datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true,
            changeMonth: true,
            yearRange: "-100:+10"
        });
        if ('' != '') {
            $("#dp4").val('');
            $("#dp4").datepicker('refresh');
        }
        if ('' != '') {
            $("#dp5").val('');
            $("#dp5").datepicker('refresh');
        }
            
        
    });
    function todayDate()
    {
        $("#dp4").val('2019-08-04');
        $("#dp5").val('2019-08-04');
    }
    function reset() {
        location.reload();
    }
    function yesterdayDate()
    {
        $("#dp4").val('2019-08-03');
        $("#dp5").val('2019-08-03');
        $("#dp4").datepicker('refresh');
        $("#dp5").datepicker('refresh');
    }
    function currentweekDate(dt, df)
    {
        $("#dp4").val('2019-07-28');
        $("#dp5").val('2019-08-03');
        $("#dp4").datepicker('refresh');
        $("#dp5").datepicker('refresh');
    }
    function previousweekDate(dt, df)
    {
        $("#dp4").val('2019-07-21');
        $("#dp5").val('2019-07-27');
        $("#dp4").datepicker('refresh');
        $("#dp5").datepicker('refresh');
    }
    function currentmonthDate(dt, df)
    {
        $("#dp4").val('2019-08-01');
        $("#dp5").val('2019-08-31');
        $("#dp4").datepicker('refresh');
        $("#dp5").datepicker('refresh');
    }
    function previousmonthDate(dt, df)
    {
        $("#dp4").val('2019-07-01');
        $("#dp5").val('2019-07-31');
        $("#dp4").datepicker('refresh');
        $("#dp5").datepicker('refresh');
    }
    function currentyearDate(dt, df)
    {
        $("#dp4").val('2019-01-01');
        $("#dp5").val('2019-12-31');
        $("#dp4").datepicker('refresh');
        $("#dp5").datepicker('refresh');
    }
    function previousyearDate(dt, df)
    {
        $("#dp4").val('2018-01-01');
        $("#dp5").val('2018-12-31');
        $("#dp4").datepicker('refresh');
        $("#dp5").datepicker('refresh');
    }
    function checkvalid() {
        if ($("#dp5").val() < $("#dp4").val()) {
            //bootbox.alert("<h4>From date should be lesser than To date.</h4>");
            bootbox.dialog({
                message: "<h4>From date should be lesser than To date.</h4>",
                buttons: {
                    danger: {
                        label: "OK",
                        className: "btn-danger"
                    }
                }
            });
            return false;
        }
    }
    

    
    

    </script>
@endsection