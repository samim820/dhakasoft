<form id="regForm" action="/action_page.php" style="width: 50%;background: none;">
 
       <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New User Registration</h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                 <div class="row" style="width: 100%">
                    <div class="form-group col-md-4">
                    <label>Customer ID</label>
                    <input readonly name="custid" type="number" value="560" class="form-control"  placeholder="Customer ID">
                  </div>
                  <div class="form-group col-md-8">
                    <label >User Full Name</label>
                    <input name="fullname" type="text" class="form-control"  placeholder="User Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Email Address</label>
                    <input name="email" type="email" class="form-control"  placeholder="Email Address">
                  </div>
                    <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Mobile</label>
                    <input name="mobile" type="text" class="form-control"  placeholder="Mobile Number">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Gender</label>
                    <select name="gender" class="form-control">
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </div>
                    <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">NID</label>
                    <input name="nid" type="text" class="form-control"  placeholder="NID Card Number">
                  </div>

                    <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">House</label>
                    <input name="house" type="text" class="form-control" id="exampleInputEmail1" placeholder="House">
                  </div>
                  <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Road</label>
                    <input name="road" type="text" class="form-control" id="exampleInputEmail1" placeholder="Road">
                  </div>
                  <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Flat</label>
                    <input name="flat" type="text" class="form-control" id="exampleInputEmail1" placeholder="Flat">
                  </div>
                  <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">Area</label>
                    <select name="area" class="form-control">
                      <option>Block-G</option>
                      <option>BLOCK-D</option>
                      <option>BLOCK-F</option>
                      <option>BLOCK-E</option>
                      <option>Paka-Mosjid</option>
                    </select>
                  </div>
                   <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">Thana</label>
                    <select name="thana" class="form-control">
                      <option>MIRPUR-1</option>
                      <option>MIRPUR-2</option>
                      <option>SHAHALI</option>
                      <option>DOKHIN-BISHIL</option>
                      <option>GABTOLI</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Post Code</label>
                    <input name="postcode" type="text" class="form-control" id="exampleInputEmail1" placeholder="Post Code">
                  </div>
                  <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">District</label>
                    <input name="distric" type="text" class="form-control" id="exampleInputEmail1" placeholder="District">
                  </div>
                  <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Remarks</label>
                    <input name="remark" type="text" class="form-control" id="exampleInputEmail1" placeholder="Remarks">
                  </div>


                  <p class="form-group col-md-12">User Conncetion Information:</p>

                    <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">User ID</label>
                    <input name="userid" type="text" class="form-control"  placeholder="User ID">
                  </div>

                    <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">Password</label>
                    <input name="password" type="text" class="form-control" id="exampleInputEmail1" placeholder="Password">
                  </div>
                  <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">Package</label>
                    <select name="package" class="form-control">
                      <option>MIRPUR-1</option>
                      <option>MIRPUR-2</option>
                      <option>SHAHALI</option>
                      <option>DOKHIN-BISHIL</option>
                      <option>GABTOLI</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label  for="exampleInputEmail1">Rent</label>
                    <input name="rent" type="text" class="form-control" id="exampleInputEmail1" placeholder="Monthly Rent">
                  </div>
                         <div class="form-group col-md-3">
                    <label  for="exampleInputEmail1">Billing Cycle</label>
                     <select name="cycle" class="form-control">
                      <option>Day 1</option>
                      <option>Day 2</option>
                      <option>Day 3</option>
                      <option>Day 4</option>
                      <option>Day 5</option>
                      <option>Day 6</option>
                      <option>Day 7</option>
                      <option>Day 8</option>
                      <option>Day 9</option>
                      <option>Day 10</option>
                   </select>
                  </div>
                      <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">POP</label>
                     <select name="pop" class="form-control">
                      <option>MIRPUR-1</option>
                      <option>MIRPUR-2</option>
                      <option>SHAHALI</option>
                      <option>DOKHIN-BISHIL</option>
                      <option>GABTOLI</option>
                    </select>
                  </div>
                        <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Connection Type</label>
                     <select name="type" class="form-control">
                      <option>UTP</option>
                      <option>FTTH</option>
                    </select>
                  </div>
                   <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Onu MAC</label>
                    <input name="onumac" type="text" class="form-control" id="exampleInputEmail1" placeholder="Onu MAC">
                  </div>





</div>
</div>

<div style="text-align: center;">
  <button class="btn btn-primary" style="width: 100px;padding: 10px;margin: 10px;">Submit</button>
</div>
  </div>



</form>