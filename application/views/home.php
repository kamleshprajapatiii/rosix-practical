<div class="mb-4 text-end">
  <button type="button" class="btn btn-outline-primary px-5 py-2" data-bs-toggle="modal" data-bs-target="#adduser">Add new user</button>
</div>
<div class="border rounded">
  <table class="table mb-0 table-hover align-middle">
    <thead>
      <tr class="text-uppercase">
        <th scope="col">ID</th>
        <th scope="col">Full name</th>
        <th scope="col">Email address</th>
        <th scope="col">Mobile number</th>
        <th scope="col">country</th>
        <th scope="col">state</th>
        <th scope="col">city</th>
        <th scope="col">datetime</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $key => $item) { ?>
        <tr>
          <td><?php echo $item->id; ?></td>
          <td><?php echo $item->fullname; ?></td>
          <td><?php echo $item->email; ?></td>
          <td><?php echo $item->mobile; ?></td>
          <td><?php echo get_countryname_by_id($item->country); ?></td>
          <td><?php echo get_statename_by_id($item->state); ?></td>
          <td><?php echo get_cityname_by_id($item->city); ?></td>
          <td><?php echo $item->datetime; ?></td>
          <td>
            <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edituser" onclick="get_user_data_ajax(<?php echo $item->id; ?>);">Edit</button>
            <a type="button" class="btn btn-outline-danger btn-sm" href="<?php echo base_url('home/deleteuser/' . $item->id); ?>">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="adduserLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url('home/adduser'); ?>" enctype="multipart/form-data">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="adduserLabel">Add new user</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Full name</label>
            <input type="text" class="form-control" name="fullname" placeholder="Enter full name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email address" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mobile number</label>
            <input type="mobile" class="form-control" name="mobile" placeholder="Enter mobile number" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Select country</label>
            <select name="country" class="form-control" id="country" required>
              <option value="">Select country</option>
              <?php foreach ($countries as $key => $item) { ?>
                <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Select state</label>
            <select name="state" class="form-control" id="state">
              <option value="">Select state</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Select city</label>
            <select name="city" class="form-control" id="city">
              <option value="">Select city</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Upload multiple images</label>
            <input type="file" class="form-control" name="images[]" multiple="multiple" id="addupload_file" onchange="addpreview_image();" accept="image/*">
          </div>
          <div id="addimage_preview"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success px-5">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="edituserLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url('home/edituser'); ?>" enctype="multipart/form-data">
        <div class="modal-header">
          <input type="hidden" hidden id="editid" name="id">
          <h1 class="modal-title fs-5" id="edituserLabel">Add new user</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Full name</label>
            <input type="text" class="form-control" name="fullname" id="editfullname" placeholder="Enter full name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="editemail" placeholder="Enter email address" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mobile number</label>
            <input type="mobile" class="form-control" name="mobile" id="editmobile" placeholder="Enter mobile number" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Select country</label>
            <select name="country" id="editcountry" class="form-control" id="country" required>
              <option value="">Select country</option>
              <?php foreach ($countries as $key => $item) { ?>
                <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Select state</label>
            <select name="state" id="editstate" class="form-control" id="state">
              <option value="">Select state</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Select city</label>
            <select name="city" id="editcity" class="form-control" id="city">
              <option value="">Select city</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Upload multiple images</label>
            <input type="file" class="form-control" name="images[]" multiple="multiple" id="editupload_file" onchange="editpreview_image();" accept="image/*">
          </div>
          <div id="editimage_preview"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success px-5">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  jQuery(document).on('change', 'select#country', function(e) {
    e.preventDefault();
    var countryID = jQuery(this).val();
    getStatesList(countryID);
  });

  jQuery(document).on('change', 'select#state', function(e) {
    e.preventDefault();
    var stateID = jQuery(this).val();
    getCityList(stateID);

  });

  jQuery(document).on('change', 'select#editcountry', function(e) {
    e.preventDefault();
    var countryID = jQuery(this).val();
    getStatesList_edit(countryID , "");
  });

  jQuery(document).on('change', 'select#editstate', function(e) {
    e.preventDefault();
    var stateID = jQuery(this).val();
    getCityList_edit(stateID, "");

  });

  function getStatesList(countryID) {
    $.ajax({
      url: window.location.origin + "/rosix-practical/home/getstates",
      type: 'post',
      data: {
        countryID: countryID
      },
      dataType: 'json',
      beforeSend: function() {
        jQuery('select#state').find("option:eq(0)").html("Please wait..");
      },
      complete: function() {},
      success: function(json) {
        var options = '';
        options += '<option value="">Select state</option>';
        for (var i = 0; i < json.length; i++) {
          options += '<option value="' + json[i].id + '">' + json[i].name + '</option>';
        }
        jQuery("select#state").html(options);

      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getCityList(stateID) {
    $.ajax({
      url: window.location.origin + "/rosix-practical/home/getcities",
      type: 'post',
      data: {
        stateID: stateID
      },
      dataType: 'json',
      beforeSend: function() {
        jQuery('select#city').find("option:eq(0)").html("Please wait..");
      },
      complete: function() {},
      success: function(json) {
        var options = '';
        options += '<option value="">Select city</option>';
        for (var i = 0; i < json.length; i++) {
          options += '<option value="' + json[i].id + '">' + json[i].name + '</option>';
        }
        jQuery("select#city").html(options);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getStatesList_edit(countryID, stateID) {
    $.ajax({
      url: window.location.origin + "/rosix-practical/home/getstates",
      type: 'post',
      data: {
        countryID: countryID
      },
      dataType: 'json',
      beforeSend: function() {
        jQuery('select#editstate').find("option:eq(0)").html("Please wait..");
      },
      complete: function() {},
      success: function(json) {
        var options = '';
        options += '<option value="">Select state</option>';
        for (var i = 0; i < json.length; i++) {
          if (json[i].id == stateID) {
            options += '<option value="' + json[i].id + '" selected> ' + json[i].name + '</option>';
          } else {
            options += '<option value="' + json[i].id + '" > ' + json[i].name + '</option>';
          }
        }
        jQuery("select#editstate").html(options);

      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getCityList_edit(stateID, cityID) {
    $.ajax({
      url: window.location.origin + "/rosix-practical/home/getcities",
      type: 'post',
      data: {
        stateID: stateID
      },
      dataType: 'json',
      beforeSend: function() {
        jQuery('select#editcity').find("option:eq(0)").html("Please wait..");
      },
      complete: function() {},
      success: function(json) {
        var options = '';
        options += '<option value="">Select city</option>';
        for (var i = 0; i < json.length; i++) {
          if (json[i].id == cityID) {
            options += '<option value="' + json[i].id + '" selected> ' + json[i].name + '</option>';
          } else {
            options += '<option value="' + json[i].id + '">' + json[i].name + '</option>';
          }
        }
        jQuery("select#editcity").html(options);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function addpreview_image() {
    var total_file = document.getElementById("addupload_file").files.length;
    for (var i = 0; i < total_file; i++) {
      $('#addimage_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' class='rounded' height='100px'>");
    }
  }

  function editpreview_image() {
    $('#editimage_preview').html('');
    var total_file = document.getElementById("editupload_file").files.length;
    for (var i = 0; i < total_file; i++) {
      $('#editimage_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' class='rounded' height='100px'>");
    }
  }

  function get_user_data_ajax(userID) {
    $.ajax({
      url: window.location.origin + "/rosix-practical/home/get_user_by_id",
      type: 'post',
      data: {
        id: userID
      },
      dataType: 'json',
      complete: function() {},
      success: function(json) {
        console.log(json);
        jQuery("#editid").val(json.id);
        jQuery("#editfullname").val(json.fullname);
        jQuery("#editemail").val(json.email);
        jQuery("#editmobile").val(json.mobile);
        jQuery("#editcountry").val(json.country);
        getStatesList_edit(json.country, json.state);
        getCityList_edit(json.state, json.city);
        var total_file = JSON.parse(json.images);
        for (var i = 0; i < total_file.length; i++) {
          $('#editimage_preview').append("<img src='./uploads/" + total_file[i] + "' class='rounded' height='100px'>");
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
</script>