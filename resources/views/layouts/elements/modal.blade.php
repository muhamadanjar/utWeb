
<!-- Modal Dialog -->
<div class="modal fade" id="formConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="frm_title">Delete</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
      </div>
      <div class="modal-body" id="frm_body"></div>
      <div class="modal-footer">
        <button style='margin-left:10px;' type="button" class="btn btn-primary col-sm-2 pull-right" id="frm_submit">Yes</button>
        <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="formModalMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="frm_title">Lihat</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
      </div>
      <div class="modal-body" id="frm_body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div id="formSaldo" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="frm_title">Tamabah Saldo</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body" id="frm_body">
            <form action="" method="post" id="frm_saldo">
                {{ @csrf_field() }}
            <div class="col-md-12">
                <input type="hidden" id="action" name="action" value="addmoney">
								<input type="hidden"  name="eTransRequest" id="eTransRequest" value="">
								<input type="hidden"  name="eType" id="eType" value="Credit">
								<input type="hidden"  name="eFor" id="eFor" value="Deposit">
								<input type="hidden"  name="user_id" id="iRiderId" value="">							
								<input type="hidden"  name="eUserType" id="eUserType" value="Rider">	
									<div class="input-group input-append">
                      <h5>Entered Amount Will Be Added Directly To Rider's Account.</h5>
                      <div class="ddtt">
                        <h4>Enter Amount</h4>
                        <input type="text" name="wallet" id="saldo" class="form-control iBalance add-ibalance" onkeyup="checkzero(this.value);">
                      </div>
                      <div id="iLimitmsg"></div>										
                    </div>
                  
            </div>
            </form>
            
          </div>
                
          <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              
          </div>
      </div>
  </div>
</div>

<div id="formInfo" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="frm_title">Detil Jalan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" id="frm_body"></div>
                  
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>



