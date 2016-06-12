	//****************** YOUR CUSTOMIZED JAVASCRIPT **********************//
	var notification_success = function (text, url) {
	  var n = $('.page-content').noty({
	            layout :'topRight',
	            text : text,
	            type: 'success',
	            timeout: 5000,
	            theme: 'defaultTheme', // or 'relax'
	            animation : {
	                          open: 'animated bounceInDown', // Animate.css class names
	                          close: 'animated bounceOutUp', // Animate.css class names
	                          easing: 'swing', // unavailable - no need
	                          speed: 500 // unavailable - no need
	                        },
	            callback : {
	              afterClose : function () {
	                // alert('test');
	                window.location = url;
	              }
	            }
	          });
	}

	$('#kabupaten').change(function(e) {
			e.preventDefault();
			var id_kabupaten = $('#kabupaten').val();
			$.getJSON(root+'index.php/json/kabupaten/kecamatan/'+id_kabupaten, function (data) {
					// console.log(data);
					$('#kecamatan').empty();
					$('#desa').empty();
					$('#kecamatan').append('<option value="">-- Pilih Kecamatan --</option>');
					$('#desa').append('<option value="">-- Pilih Desa / Kelurahan --</option>');
					$.each(data, function (i, item) {
						$('#kecamatan').append('<option value="'+data[i].id_kecamatan+'">'+data[i].nama_kecamatan+'</option>')
					})
					$('#kecamatan').select2().select2("val", null);
					$('#desa').select2().select2("val", null);
				});
			return false;
		});

	$('#kecamatan').change(function(e) {
			e.preventDefault();
			
			var id_kabupaten = $('#kabupaten').val();
			var id_kecamatan = $('#kecamatan').val();

			$.getJSON(root+'index.php/json/kabupaten/kecamatan/kelurahan/' + id_kabupaten + '/' + id_kecamatan, function (data) {
					// console.log(data);
					$('#desa').empty();
					$('#desa').append('<option value="">-- Pilih Desa / Kelurahan --</option>');
					$.each(data, function (i, item) {
						$('#desa').append('<option value="'+data[i].id_desa+'">'+data[i].desa+'</option>')
					})
					$('#desa').select2().select2("val", null);
				});
			return false;
		});

	// $('#kabupaten').hide();
	$('#status').change(function(e) {
			e.preventDefault();
			
			if ($('#status').val() == '0') {
				$('#kabupaten').show();
			}else{
				$('#id_kabupaten').select2().select2("val", '0');
				$('#kabupaten').hide();
			};

			return false;
		});


	$('#form_create_perusahaan').submit(function(e) {
			e.preventDefault();
			formData = new FormData($(this)[0]);
			$.ajax({
				url: root+'index.php/submit/perusahaan',
			      type: 'POST',
			      data: formData,
			      async:false,
			      cache:false,
			      processData: false,
			      contentType: false,
			      success:function (data) {
			      	var url			= root + "index.php/perusahaan";
			      	var n = noty({
			      	          layout :'topRight',
			      	          text : 'Data Telah Ditambahkan',
			      	          type: 'success',
			      	          timeout: 5000,
			      	          theme: 'defaultTheme', // or 'relax'
			      	          animation : {
			      	                        open: 'animated bounceInDown', // Animate.css class names
			      	                        close: 'animated bounceOutUp', // Animate.css class names
			      	                        easing: 'swing', // unavailable - no need
			      	                        speed: 500 // unavailable - no need
			      	                      },
			      	          callback : {
			      	            afterClose : function () {
			      	              window.location = url;
			      	            }
			      	          }
			      	        });
			      }
			});
			return false;
		});

	$('#form_edit_perusahaan').submit(function(e) {
			e.preventDefault();
			formData = new FormData($(this)[0]);
			$.ajax({
				url: root+'index.php/update/perusahaan',
			      type: 'POST',
			      data: formData,
			      async:false,
			      cache:false,
			      processData: false,
			      contentType: false,
			      success:function (data) {
			      	var url			= root + "index.php/perusahaan";
			      	var n = noty({
			      	          layout :'topRight',
			      	          text : 'Data Telah Dirubah',
			      	          type: 'success',
			      	          timeout: 5000,
			      	          theme: 'defaultTheme', // or 'relax'
			      	          animation : {
			      	                        open: 'animated bounceInDown', // Animate.css class names
			      	                        close: 'animated bounceOutUp', // Animate.css class names
			      	                        easing: 'swing', // unavailable - no need
			      	                        speed: 500 // unavailable - no need
			      	                      },
			      	          callback : {
			      	            afterClose : function () {
			      	              window.location = url;
			      	            }
			      	          }
			      	        });
			      }
			});
			return false;
		});

	var table = $('#table').DataTable({
		"searchHighlight": true,
		"lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "Semua"] ],
		"language": {
		            "sProcessing":   "Sedang memproses...",
		            // "sLengthMenu":   "Tampilkan _MENU_ entri",
		            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
		            "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
		            "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
		            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
		            "sInfoPostFix":  "",
		            // "sSearch":       "Cari:",
		            "sUrl":          "",
		            "oPaginate": {
		                "sFirst":    "Pertama",
		                "sPrevious": "Sebelumnya",
		                "sNext":     "Selanjutnya",
		                "sLast":     "Terakhir"
		            }
		        },
		"processing": true,
		// "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
		"ajax":root + "index.php/perusahaan/json",
		"columns": [
		            { 	
		            	"data": "nomor",
		            	"orderable": true, 
		            	"width":"5%" 
		            },
		            { 	"data": "fnama", 
		            	"orderable": true, 
		            	"width":"15%" 
		            },
		            { 	"data": "falamat", 
		            	"orderable": true, 
		            	"width":"20%"  
		            },
		            { 	"data": "nama_kabupaten", 
		            	"orderable": true, 
		            	"width":"15%"  
		            },
		            { 	"data": "nama_kecamatan", 
		            	"orderable": true, 
		            	"width":"10%"  
		            },
		            { 	"data": null,
		            	"render": function (data) {
		            		if (data.fstatus == 0) {
		            			return '<span style="color:red;">Tidak Aktif</span>';
		            		}else{
		            			return '<span style="color:green;">Aktif</span>';
		            		}
		            	},
		             	"orderable": true, 
		             	"width":"10%" 
		            },
		            { 	"data": null,
		                "render" : function (data) {
		                    return '<div class="row" style="margin-bottom:10px">' +
	                              		'<div class="col-xs-4">' +
	                                		'<a title="Detail" href="' + root + 'index.php/perusahaan/' + data.id_perusahaan + '" class="btn btn-sm btn-info btn-square"><i class="fa fa-search"></i></a>' +
	                              		'</div>'+
	                            	  	'<div class="col-xs-4">' +
	                            	    	'<a title="Edit" href="' + root + 'index.php/perusahaan/edit/' + data.id_perusahaan + '" class="btn btn-sm btn-success btn-square"><i class="fa fa-pencil-square-o"></i></a>' +
	                            	  	'</div>' +
	                            	  	'<div class="col-xs-4">' +
	                            	    	'<a title="Hapus" href="' + root + 'index.php/perusahaan/delete/' + data.id_perusahaan + '" class="btn btn-sm btn-danger btn-square" onclick="return confirm(\'Apakah Anda Yakin Untuk Menghapus Data Ini?\')"><i class="fa fa-ban"></i></a>' +
	                            	  	'</div>' +
	                            	'</div>';
		                },
		                "orderable": false, 
		             	"width":"15%" 
		            }
		        ],
	});

	// $('<div class="btn-group"><button type="button" class="btn btn-info btn-square dropdown-toggle" data-toggle="dropdown"><i class="fa fa-spinner fa-spin" id="loading"></i> Cetak <span class="caret"></span></button><span class="dropdown-arrow"></span><ul class="dropdown-menu" role="menu"><li><a href="javascript:void(0)" id="print_pdf">Cetak PDF</a></li><li><a href="javascript:void(0)" id="print_excel">Cetak Excel</a></li></ul></div>').appendTo('div#table_filter');
	// $('#loading').hide();

	// $("#print_pdf").click(function() {
	//     var rowTable = [];
	//     table.rows( { search:'applied' } ).data().each(function(value, index) {
	//         rowTable.push( value.id_perusahaan );
	//     });

	//     $.ajax({
	//     	url: root+'index.php/perusahaan/print/pdf',
	//           type: 'POST',
	//           data: { perusahaan : rowTable },
	//           dataType:"json",
	//           beforeSend:function () {
	//           	console.log('sending');
	//           	$('#loading').show();
	//           },
	//           success:function (msg) {
	//           	console.log( msg );
	//           	window.open(msg);
	//           },
	//           error:function (xhr) {
	//           	console.log(xhr.statusText + xhr.responseText);
	//           	alert('PDF tidak bisa dibuat');
	//           },
	//           complete:function () {
	//           	console.log('send complete');
	//           	$('#loading').hide();
	//           }
	//     });

	//     // console.log( JSON.stringify({ perusahaan: rowTable }) );
	// });

	// $("#print_excel").click(function() {

	//     var rowTable = [];
	//     table.rows( { search:'applied' } ).data().each(function(value, index) {
	//         rowTable.push( value.id_perusahaan );
	//     });

	//     params_perusahaan = rowTable.join();

	//     window.open( root + 'index.php/perusahaan/print/excel/' + params_perusahaan );
	// });

	var table = $('#master_table').DataTable({
		"searchHighlight": true,
		"lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "Semua"] ],
		"language": {
		            "sProcessing":   "Sedang memproses...",
		            // "sLengthMenu":   "Tampilkan _MENU_ entri",
		            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
		            "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
		            "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
		            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
		            "sInfoPostFix":  "",
		            // "sSearch":       "Cari:",
		            "sUrl":          "",
		            "oPaginate": {
		                "sFirst":    "Pertama",
		                "sPrevious": "Sebelumnya",
		                "sNext":     "Selanjutnya",
		                "sLast":     "Terakhir"
		            }
		        },
	});