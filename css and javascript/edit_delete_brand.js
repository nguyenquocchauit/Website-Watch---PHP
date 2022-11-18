$(document).ready(function () {
  // Bắt sự kiện click thêm giỏ hàng thêm hiệu ứng animation tới icon giỏ hàng
  $('#delete').on('click', function () {
    var _idbrand = document.getElementById('idbrand').value;
    console.log(_idbrand);
    Swal.fire({
      title: 'Bạn chắc chắn muốn xóa?',
      text: "Xóa sẽ không thể nào hoàn tác!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Đồng ý',
      cancelButtonText: "Thoát",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'POST',
          url: 'inlcudes_function/delete.php',
          data: {
            action: "delete",
            idbrand: _idbrand,
          },
          success: function (data) {
            var data = JSON.parse(data);
            console.log(data);
            if (data['key'] == 'Xóa thành công') {
              Swal.fire({
                icon: 'success',
                title: 'Đã xóa!',
                timer: 1200,
                timerProgressBar: true,
              }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) { window.location.href = "listbrand.php"; }
              })
            }
          }
        });
      }
    })
  });

  $('#edit').on('click', function () {
    var _idbrand = document.getElementById('idbrand').value;
    var _namebrand = document.getElementById('namebrand').value;
    console.log(_idbrand);
    console.log(_namebrand);
    Swal.fire({
      title: 'Bạn có muốn lưu thay đổi không?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Có',
      denyButtonText: `Không`,
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'POST',
          url: 'inlcudes_function/edit.php',
          data: {
            action: "edit",
            idbrand: _idbrand,
            namebrand: _namebrand,
          },
          success: function (data) {
            var data = JSON.parse(data);
            console.log(data);
            if (data['key'] == 'Sửa thành công') {
              Swal.fire({
                icon: 'success',
                title: 'Thay đổi thành công!',
                timer: 1200,
                timerProgressBar: true,
              }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) { window.location.href = "listbrand.php"; }
              })
            }
          }
        });
      } else {
        Swal.fire('Các thay đổi không được lưu', '', 'info')
      }

    })
  });


  $('#insert').on('click', function () {
    var _idbrand = document.getElementById('idbrand').value;
    var _namebrand = document.getElementById('namebrand').value;
    console.log(_idbrand + "&" + _namebrand);
    if (_idbrand == "" || _idbrand.length == 0) {
      Swal.fire({
        icon: 'error',
        title: 'Thông báo!',
        text: 'Mã nhãn hàng không được để trống!',
        timer: 1500,
        timerProgressBar: true,
      })
    } else if (_namebrand == "" || _namebrand.length == 0) {
      Swal.fire({
        icon: 'error',
        title: 'Thông báo!',
        text: 'Tên nhãn hàng không được để trống!',
        timer: 1500,
        timerProgressBar: true,
      })
    } else {
      Swal.fire({
        title: 'Bạn có muốn tạo sản phẩm không?',
        confirmButtonText: 'Có',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'POST',
            url: 'inlcudes_function/xulyaddbrand.php',
            data: {
              action: "insert",
              idbrand: _idbrand,
              namebrand: _namebrand,
            },
            success: function (data) {
              var data = JSON.parse(data);
              console.log(data);
              if (data['key'] == 'Thêm thành công') {
                Swal.fire({
                  icon: 'success',
                  title: 'Tạo thành công!',
                  timer: 1200,
                  timerProgressBar: true,
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) { window.location.href = "listbrand.php"; }
                })
              } if (data['key'] == 'Trùng tên nhãn hàng') {
                Swal.fire('Trùng tên nhãn hàng')
              } if (data['key'] == 'Trùng mã nhãn hàng') {
                Swal.fire('Trùng mã nhãn hàng')
              }
            }
          });
        } else {
          Swal.fire('Changes are not saved', '', 'info')
        }

      })
    }
  });
});