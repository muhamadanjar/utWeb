@extends('templates::adminlte.main')
@section('content-admin')
    
<div class="row">
	<div class="col-md-12">
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title">Fare Settings				</h3>
			</div>
			<div class="card-body">
				<div>
					<ul class="nav nav-pills custom">
											<li class="nav-item"><a href="#hatchback" data-toggle="tab" class="nav-link text-uppercase"> Hatchback <i class="fa"></i></a></li>
											<li class="nav-item"><a href="#sedan" data-toggle="tab" class="nav-link text-uppercase"> Sedan <i class="fa"></i></a></li>
											<li class="nav-item"><a href="#minivan" data-toggle="tab" class="nav-link text-uppercase active show"> Mini van <i class="fa"></i></a></li>
											<li class="nav-item"><a href="#saloon" data-toggle="tab" class="nav-link text-uppercase  "> Saloon <i class="fa"></i></a></li>
											<li class="nav-item"><a href="#suv" data-toggle="tab" class="nav-link text-uppercase  "> SUV <i class="fa"></i></a></li>
											<li class="nav-item"><a href="#bus" data-toggle="tab" class="nav-link text-uppercase  "> Bus <i class="fa"></i></a></li>
											<li class="nav-item"><a href="#truck" data-toggle="tab" class="nav-link text-uppercase  "> Truck <i class="fa"></i></a></li>
										</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tab-content card-body">
														
							<div class="tab-pane" id="hatchback">
								<form method="POST" action="https://f4.hyvikk.space/fare-settings?tab=hatchback" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="j4M88VyhnRYmEfNuvTbP3ptzUYs89cyAjQY9nxmc">
								<div class="row">
									<div class="form-group col-md-3">
										<label for="hatchback_base_fare" class="form-label">Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[hatchback_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_base_km" class="form-label">Base km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[hatchback_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_base_time" class="form-label">Waiting Time per minute</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[hatchback_base_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_std_fare" class="form-label">Std. Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[hatchback_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_weekend_base_fare" class="form-label">Weekend Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[hatchback_weekend_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_weekend_base_km" class="form-label">Weekend Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[hatchback_weekend_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_weekend_wait_time" class="form-label">Weekend Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[hatchback_weekend_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_weekend_std_fare" class="form-label">Weekend Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[hatchback_weekend_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_night_base_fare" class="form-label">Night Base Fare</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[hatchback_night_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_night_base_km" class="form-label">Night Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[hatchback_night_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_night_wait_time" class="form-label">Night Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[hatchback_night_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="hatchback_night_std_fare" class="form-label">Night Fare per km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[hatchback_night_std_fare]" type="number" value="20">
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="col-md-2">
										<div class="form-group">
											<input type="submit" class="form-control btn btn-success" value="Save">
										</div>
									</div>
								</div>
								</form>
							</div>
														
							<div class="tab-pane" id="sedan">
								<form method="POST" action="https://f4.hyvikk.space/fare-settings?tab=sedan" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="j4M88VyhnRYmEfNuvTbP3ptzUYs89cyAjQY9nxmc">
								<div class="row">
									<div class="form-group col-md-3">
										<label for="sedan_base_fare" class="form-label">Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[sedan_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_base_km" class="form-label">Base km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[sedan_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_base_time" class="form-label">Waiting Time per minute</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[sedan_base_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_std_fare" class="form-label">Std. Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[sedan_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_weekend_base_fare" class="form-label">Weekend Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[sedan_weekend_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_weekend_base_km" class="form-label">Weekend Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[sedan_weekend_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_weekend_wait_time" class="form-label">Weekend Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[sedan_weekend_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_weekend_std_fare" class="form-label">Weekend Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[sedan_weekend_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_night_base_fare" class="form-label">Night Base Fare</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[sedan_night_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_night_base_km" class="form-label">Night Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[sedan_night_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_night_wait_time" class="form-label">Night Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[sedan_night_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="sedan_night_std_fare" class="form-label">Night Fare per km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[sedan_night_std_fare]" type="number" value="20">
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="col-md-2">
										<div class="form-group">
											<input type="submit" class="form-control btn btn-success" value="Save">
										</div>
									</div>
								</div>
								</form>
							</div>
														
							<div class="tab-pane active show" id="minivan">
								<form method="POST" action="https://f4.hyvikk.space/fare-settings?tab=minivan" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="j4M88VyhnRYmEfNuvTbP3ptzUYs89cyAjQY9nxmc">
								<div class="row">
									<div class="form-group col-md-3">
										<label for="minivan_base_fare" class="form-label">Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[minivan_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_base_km" class="form-label">Base km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[minivan_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_base_time" class="form-label">Waiting Time per minute</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[minivan_base_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_std_fare" class="form-label">Std. Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[minivan_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_weekend_base_fare" class="form-label">Weekend Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[minivan_weekend_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_weekend_base_km" class="form-label">Weekend Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[minivan_weekend_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_weekend_wait_time" class="form-label">Weekend Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[minivan_weekend_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_weekend_std_fare" class="form-label">Weekend Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[minivan_weekend_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_night_base_fare" class="form-label">Night Base Fare</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[minivan_night_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_night_base_km" class="form-label">Night Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[minivan_night_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_night_wait_time" class="form-label">Night Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[minivan_night_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="minivan_night_std_fare" class="form-label">Night Fare per km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[minivan_night_std_fare]" type="number" value="20">
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="col-md-2">
										<div class="form-group">
											<input type="submit" class="form-control btn btn-success" value="Save">
										</div>
									</div>
								</div>
								</form>
							</div>
														
							<div class="tab-pane " id="saloon">
								<form method="POST" action="https://f4.hyvikk.space/fare-settings?tab=saloon" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="j4M88VyhnRYmEfNuvTbP3ptzUYs89cyAjQY9nxmc">
								<div class="row">
									<div class="form-group col-md-3">
										<label for="saloon_base_fare" class="form-label">Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[saloon_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_base_km" class="form-label">Base km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[saloon_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_base_time" class="form-label">Waiting Time per minute</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[saloon_base_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_std_fare" class="form-label">Std. Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[saloon_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_weekend_base_fare" class="form-label">Weekend Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[saloon_weekend_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_weekend_base_km" class="form-label">Weekend Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[saloon_weekend_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_weekend_wait_time" class="form-label">Weekend Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[saloon_weekend_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_weekend_std_fare" class="form-label">Weekend Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[saloon_weekend_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_night_base_fare" class="form-label">Night Base Fare</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[saloon_night_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_night_base_km" class="form-label">Night Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[saloon_night_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_night_wait_time" class="form-label">Night Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[saloon_night_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="saloon_night_std_fare" class="form-label">Night Fare per km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[saloon_night_std_fare]" type="number" value="20">
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="col-md-2">
										<div class="form-group">
											<input type="submit" class="form-control btn btn-success" value="Save">
										</div>
									</div>
								</div>
								</form>
							</div>
														
							<div class="tab-pane " id="suv">
								<form method="POST" action="https://f4.hyvikk.space/fare-settings?tab=suv" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="j4M88VyhnRYmEfNuvTbP3ptzUYs89cyAjQY9nxmc">
								<div class="row">
									<div class="form-group col-md-3">
										<label for="suv_base_fare" class="form-label">Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[suv_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_base_km" class="form-label">Base km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[suv_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_base_time" class="form-label">Waiting Time per minute</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[suv_base_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_std_fare" class="form-label">Std. Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[suv_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_weekend_base_fare" class="form-label">Weekend Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[suv_weekend_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_weekend_base_km" class="form-label">Weekend Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[suv_weekend_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_weekend_wait_time" class="form-label">Weekend Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[suv_weekend_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_weekend_std_fare" class="form-label">Weekend Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[suv_weekend_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_night_base_fare" class="form-label">Night Base Fare</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[suv_night_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_night_base_km" class="form-label">Night Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[suv_night_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_night_wait_time" class="form-label">Night Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[suv_night_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="suv_night_std_fare" class="form-label">Night Fare per km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[suv_night_std_fare]" type="number" value="20">
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="col-md-2">
										<div class="form-group">
											<input type="submit" class="form-control btn btn-success" value="Save">
										</div>
									</div>
								</div>
								</form>
							</div>
														
							<div class="tab-pane " id="bus">
								<form method="POST" action="https://f4.hyvikk.space/fare-settings?tab=bus" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="j4M88VyhnRYmEfNuvTbP3ptzUYs89cyAjQY9nxmc">
								<div class="row">
									<div class="form-group col-md-3">
										<label for="bus_base_fare" class="form-label">Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[bus_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_base_km" class="form-label">Base km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[bus_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_base_time" class="form-label">Waiting Time per minute</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[bus_base_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_std_fare" class="form-label">Std. Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[bus_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_weekend_base_fare" class="form-label">Weekend Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[bus_weekend_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_weekend_base_km" class="form-label">Weekend Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[bus_weekend_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_weekend_wait_time" class="form-label">Weekend Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[bus_weekend_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_weekend_std_fare" class="form-label">Weekend Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[bus_weekend_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_night_base_fare" class="form-label">Night Base Fare</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[bus_night_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_night_base_km" class="form-label">Night Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[bus_night_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_night_wait_time" class="form-label">Night Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[bus_night_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="bus_night_std_fare" class="form-label">Night Fare per km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[bus_night_std_fare]" type="number" value="20">
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="col-md-2">
										<div class="form-group">
											<input type="submit" class="form-control btn btn-success" value="Save">
										</div>
									</div>
								</div>
								</form>
							</div>
														
							<div class="tab-pane " id="truck">
								<form method="POST" action="https://f4.hyvikk.space/fare-settings?tab=truck" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="j4M88VyhnRYmEfNuvTbP3ptzUYs89cyAjQY9nxmc">
								<div class="row">
									<div class="form-group col-md-3">
										<label for="truck_base_fare" class="form-label">Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[truck_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_base_km" class="form-label">Base km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[truck_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_base_time" class="form-label">Waiting Time per minute</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[truck_base_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_std_fare" class="form-label">Std. Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[truck_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_weekend_base_fare" class="form-label">Weekend Base Fare</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[truck_weekend_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_weekend_base_km" class="form-label">Weekend Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[truck_weekend_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_weekend_wait_time" class="form-label">Weekend Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[truck_weekend_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_weekend_std_fare" class="form-label">Weekend Fare per km</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[truck_weekend_std_fare]" type="number" value="20">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_night_base_fare" class="form-label">Night Base Fare</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[truck_night_base_fare]" type="number" value="500">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_night_base_km" class="form-label">Night Base km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">km</span></div>
											<input class="form-control" required="" name="name[truck_night_base_km]" type="number" value="10">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_night_wait_time" class="form-label">Night Waiting Time</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>

											<input class="form-control" required="" name="name[truck_night_wait_time]" type="number" value="2">
										</div>
									</div>

									<div class="form-group col-md-3">
										<label for="truck_night_std_fare" class="form-label">Night Fare per km</label>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
											<span class="input-group-text">₹</span></div>
											<input class="form-control" required="" name="name[truck_night_std_fare]" type="number" value="20">
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="col-md-2">
										<div class="form-group">
											<input type="submit" class="form-control btn btn-success" value="Save">
										</div>
									</div>
								</div>
								</form>
							</div>
													</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
      
@endsection