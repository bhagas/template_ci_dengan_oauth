
<!DOCTYPE html>
<html>
<head>
    <title>Peta Online IHT</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet.css" />
    <!-- <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ui.css" rel="stylesheet">
    <!--[if lte IE 8]><link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.ie.css" /><![endif]-->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet-sidebar.min.css" />
    <link href="<?php echo base_url(); ?>assets/css/leaflet.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet.extra-markers.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet-routing-machine.css" />
    
    <script src="<?php echo base_url(); ?>assets/js/leaflet.js"></script>
    <script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
    <script src="<?php echo base_url(); ?>assets/js/google-leaf.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/leaflet.extra-markers.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/js/L.Control.Locate.js" ></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/leaflet-routing-machine.js"></script>
    <script src="<?php echo base_url() ?>assets/js/leaflet-sidebar.js"></script>
    <script type="text/javascript">
        var root = '<?php echo base_url() ?>';
    </script>
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        html, body, #map {
            height: 100%;
            font: 10pt "Helvetica Neue", Arial, Helvetica, sans-serif;
        }

        .lorem {
            font-style: italic;
            color: #AAA;
        }
    </style>
</head>
<body>
    <div id="sidebar" class="sidebar collapsed">
        <!-- Nav tabs -->
        <div class="sidebar-tabs">
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-search"></i></a></li>
                <!-- <li><a href="#profile" role="tab"><i class="fa fa-user"></i></a></li> -->
                <!-- <li class="disabled"><a href="#messages" role="tab"><i class="fa fa-envelope"></i></a></li> -->
            </ul>

            <ul role="tablist">
                <!-- <li><a href="#settings" role="tab"><i class="fa fa-gear"></i></a></li> -->
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="sidebar-content">
            <div class="sidebar-pane" id="home">
                <h1 class="sidebar-header">
                    Industri Hasil Tembakau
                    <div class="sidebar-close"><i class="fa fa-caret-left"></i></div>
                </h1>
                <div class="container-fluid m-t-20">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group m-b-10 m-r-20">
                                <input type="text" class="form-control" placeholder="Cari Perusahaan" id="nama_perusahaan">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" style="width:100%" onclick="cari_perusahaan()">Cari</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <table id="search_result">
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <p>A responsive sidebar for mapping libraries like  -->
                <!-- <a href="javascript:void(0)" onclick="sidebar.close();">close</a> or <a href="http://openlayers.org/">OpenLayers</a>.</p> -->

                
            </div>

            <div class="sidebar-pane" id="profile">
                <h1 class="sidebar-header">Profile<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
            </div>

            <div class="sidebar-pane" id="messages">
                <h1 class="sidebar-header">Messages<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
            </div>

            <div class="sidebar-pane" id="settings">
                <h1 class="sidebar-header">Settings<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
            </div>
        </div>
    </div>

    <div id="map" class="sidebar-map"></div>

    <script>
        /**
         * 
         *  FUNCTION COLLECTION
         *
         */

        function onLocationFound(e) {
          var radius = e.accuracy / 2;
          if(marker != undefined){
            map.removeLayer(marker);
            map.removeLayer(lingkaran);
          }
          if(center == 0 ){
            map.setView(e.latlng, 13);
            center++;
          }
          //L.marker(e.latlng).addTo(map)
          marker = new L.Marker(e.latlng,{icon: locateIcon});
          map.addLayer(marker);
          //L.circle(e.latlng, radius).addTo(map);
          lingkaran = new L.circle(e.latlng, radius);
          map.addLayer(lingkaran);
          
          //iki iso
          iht_layer.eachLayer(function (layer) {
            layer_lat_long = layer.getLatLng();
            layer_lat = layer.getLatLng().lat;
            layer_lng = layer.getLatLng().lng;
            //alert(layer_lat_long);
            // jarak To current point in meters
            var posisi_kita_lat = e.latlng.lat;
            var posisi_kita_lng = e.latlng.lng;
            //console.log(posisi_kita_lat)
            jarak = layer_lat_long.distanceTo(e.latlng);
            // var popupContent = '<div class="row">' + 
            //     '<div class="col-sm-12">' + 
            //       '<p class="f-18 m-b-0 m-t-0"><strong>' + layer.feature.properties.nama_perusahaan + '</strong></p>' +
            //       '<p class="f-12 m-t-10 m-b-0"> &nbsp; &nbsp;' + layer.feature.properties.nama_kabupaten + '</p>' +
            //       '<p class="f-12 m-t-0 m-b-0"> &nbsp; &nbsp;' + layer.feature.properties.alamat + '</p>' +
            //       '<p class="f-12 m-t-0 m-b-0"> &nbsp; &nbsp; Kecamatan ' + layer.feature.properties.nama_kecamatan + '</p>' +
            //       '<p class="f-12 m-t-0 m-b-10"> &nbsp; &nbsp; Jarak Udara ' + Math.round((jarak / 1000) * 100) / 100 + ' Kilometer</p>' +
            //     '</div>' +
            //     '</br>' +
            //     '<div class="col-sm-12 m-t-10">' + 
            //       '<a href="' + root +'index.php/mobile/perusahaan/' + layer.feature.properties.id_perusahaan + '" class="btn btn-success btn-sm m-b-0 text-right" style="width:100%" target="_blank"><i class="fa fa-search"></i> Detail</a>' +
            //     '</div>' +
            //     '<div class="col-sm-12 m-t-10">' + 
            //       '<a href="javascript:void(0)" onclick="ke_lokasi(' + posisi_kita_lat + ',' + posisi_kita_lng + ',' + layer_lat + ',' + layer_lng + ')" class="btn btn-warning btn-sm m-b-0 text-right" style="width:100%"><i class="fa fa-location-arrow"></i> Ke Lokasi</a>' +
            //     '</div>' +
            //     '<div class="col-sm-12 m-t-10">' + 
            //       '<a href="http://maps.apple.com/?q=' + layer.feature.properties.latitude + ',' + layer.feature.properties.longitude + '" class="btn btn-warning btn-sm m-b-0 text-right" style="width:100%" target="_blank"><i class="fa fa-location-arrow"></i> Ke Lokasi (Google Maps)</a>' +
            //     '</div>' +
            //     '</div>';
            var lokasiFoto = root + 'assets/images/foto/' + layer.feature.properties.foto + '.JPG';
            var jenis_produk_show = ''; 
            var merek_produk_show = '';
            $.each(layer.feature.properties.jenis_produk, function () {
              jenis_produk_show += '<i class="fa fa-caret-right"></i> '+ this.nama_produk +' ('+ this.singkatan_produk +')<br>';
            })
            $.each(layer.feature.properties.merek_produk, function () {
              merek_produk_show += '<i class="fa fa-caret-right"></i> '+ this.nama_merk_dagang_sudah_registrasi +'<br>';
            })
            var popupContent = '<div class="row">' + 
                      '<div class="col-sm-12">' + 
                        '<p class="f-18 m-b-10 m-t-0"><strong>' + layer.feature.properties.nama_perusahaan + '</strong></p>' +
                        '<table class="custom-table">' +
                        '<tr><td valign="top" width="70">Alamat</td><td width="10" valign="top"> : </td><td>' + layer.feature.properties.alamat + ', ' + layer.feature.properties.nama_kabupaten + '</td></tr>' +
                        '<tr><td valign="top" width="70">Pemilik</td><td width="10" valign="top"> : </td><td>' + layer.feature.properties.pemilik + '</td></tr>' +
                        '<tr><td valign="top" width="70">CP</td><td width="10" valign="top"> : </td><td>' + layer.feature.properties.nama_contact_person + '</td></tr>' +
                        '<tr><td valign="top" width="70">Contact</td><td width="10" valign="top"> : </td><td>' + layer.feature.properties.contact + '</td></tr>' +
                        '<tr><td valign="top" width="70">Produk</td><td width="10" valign="top"> : </td><td>' + jenis_produk_show + '</td></tr>' +
                        '<tr><td valign="top" width="70">Merek</td><td width="10" valign="top"> : </td><td>' + merek_produk_show + '</td></tr>' +
                        '<tr><td valign="top" width="70">Options</td><td width="10" valign="top"> : </td><td>' + 
                        '<a href="' + root +'index.php/mobile/perusahaan/' + layer.feature.properties.id_perusahaan + '" class="btn btn-success btn-sm m-b-0 text-right" style="width:100%" target="_blank"><i class="fa fa-search"></i> Detail</a>' +
                        '<a href="javascript:void(0)" onclick="ke_lokasi(' + posisi_kita_lat + ',' + posisi_kita_lng + ',' + layer_lat + ',' + layer_lng + ')" class="btn btn-warning btn-sm m-b-0 text-right" style="width:100%"><i class="fa fa-location-arrow"></i> Ke Lokasi</a>' +
                        '</td></tr>' +
                        '<tr><td valign="top" width="70">Foto</td><td width="10" valign="top"> : </td><td><img class="img img-thumbnail" src="' + lokasiFoto + '" width="200"></td></tr>' +
                        '</table>' +
                        // '<p class="f-12 m-t-10 m-b-0"> <i class="fa fa-dot-circle-o"></i></p>' +
                        // '<p class="f-12 m-t-0 m-b-0"> <i class="fa fa-dot-circle-o"></i> ' + feature.properties.alamat + '</p>' +
                        // '<p class="f-12 m-t-0 m-b-0"> <i class="fa fa-dot-circle-o"></i> ' + feature.properties.pemilik + '</p>' +
                        // '<p class="f-12 m-t-0 m-b-0"> <i class="fa fa-dot-circle-o"></i> ' + feature.properties.nama_contact_person + '</p>' +
                        // '<p class="f-12 m-t-0 m-b-0"> <i class="fa fa-dot-circle-o"></i> ' + feature.properties.contact_person + '</p>' +
                      '</div>' +
                      '</br>' +
                      '</div>';
            layer.bindPopup(popupContent, popupOptions);
            // layer.bindPopup(layer.feature.properties.nama_perusahaan+'<br><a href="#" onclick="ke_lokasi('+posisi_kita_lat+','+posisi_kita_lng+','+layer_lat+','+layer_lng+')">Ke Lokasi</a><br><a href="http://maps.apple.com/?q='+layer.feature.properties.ye+','+layer.feature.properties.xe+'">Ke Lokasi(googlemaps)</a></br>Jarak Udara : '+jarak/1000+' Kilometer');
             if(jarak > 30000){
               // layer.setOpacity(0);
            }
          });
        }

        function tambah_titik(x, y, id_perusahaan){
            sidebar.close()
          map.panTo(new L.LatLng(x, y));
          map.setZoom(16);

          iht_layer.eachLayer(function (layer) {
            if ( layer.feature.properties.id_perusahaan == id_perusahaan ) {
              console.log(layer.feature.properties)
              layer.openPopup();
            };
          });
        }

        function cari_perusahaan(){
            var nama_perusahaan = $('#nama_perusahaan').val();
            if ( nama_perusahaan != '') {
              $.ajax({
                type : "GET",
                async : false,
                global : false,
                url : root + "index.php/perusahaan/search/" + nama_perusahaan +'',
                dataType : 'json',
                beforesend: function () {
                  
                },
                success: function (data) {
                  $('#search_result  tbody').empty();
                  $.each(data, function (i, item) {
                    $('#search_result  tbody:last-child').append('<tr><td><a href="javascript:void(0)" onclick="tambah_titik(' + item.latitude + ', ' + item.longitude + ', ' + item.id_perusahaan + ')">' + item.nama_perusahaan + '</a></td></tr>');
                  })
                }
              });
            }else{
              $('#search_result').empty();
            }
        }

        function ke_lokasi(x_awal, y_awal, x_akhir, y_akhir){
          map.closePopup();

          if(navigasi!=null){
            navigasi.spliceWaypoints(navigasi.getWaypoints().length - 1, 1, L.latLng(x_akhir, y_akhir));   
          }
          else{
            navigasi =  L.Routing.control({
              // waypointIcon :
              // waypoints : [L.latLng(x_awal, y_awal), L.latLng(x_akhir, y_akhir)]
              plan: L.Routing.plan([
                  L.latLng(x_awal, y_awal),
                  L.latLng(x_akhir, y_akhir)
              ], 
              {
                createMarker: function(i, wp) {
                  return L.marker(wp.latLng, {
                    draggable: true,
                    icon: routeIcon
                  });
                }
                // geocoder: L.Control.Geocoder.nominatim(),
                // routeWhileDragging: true
              })
            });
            navigasi.addTo(map);
            console.log(navigasi.getPlan());
            $('.leaflet-routing-container').append('<a href="#" id="tutup_navigasi" onclick="tutup_navigasi()">BATAL</a>');
          }
        }
        
        function tutup_navigasi() {
          if(navigasi!=null){
            navigasi.spliceWaypoints(0, 2);
            $('.leaflet-routing-container').hide();
            navigasi = null;
          }
        };

        /**
        * 
        *  END OF FUNCTION COLLECTION
        *
        **/

        /**
        * 
        *  MAP Initialization
        *
        **/
        var map = L.map('map', {
            center: [-6.2087630, 106.8455990],
            zoom: 8,
            minZoom:7,
            maxZoom:17
        });
        var google_roadmap    = new L.Google('ROADMAP');
        var google_hybrid     = new L.Google('HYBRID');
        var google_satelit    = new L.Google('SATELLITE');
        var osm               = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {});
        var Esri_WorldImagery = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {});
        var mapbox            = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6IjZjNmRjNzk3ZmE2MTcwOTEwMGY0MzU3YjUzOWFmNWZhIn0.Y8bhBaUMqFiPrDRW9hieoQ', {
                                  maxZoom: 18,
                                  id: 'mapbox.streets'
                                });

        map.addLayer(osm);
        //ambil titik industri
        //ambil kabupaten geo
        var iht_layer = null;
        var source = null;
        var navigasi=null;
        var marker;   
        var lingkaran;
        var center = 0;
        
        var popupOptions = {
          maxWidth : '300',
          className : 'custom',
          closeOnClick : true
        };

        var style_kabupaten = {
          color : "white", 
          weight : 1, 
          opacity : 1, 
          fillOpacity  : 0,
          dashArray : 3
        };

        var locateIcon = L.ExtraMarkers.icon({
            icon: 'fa-map-marker', 
            markerColor: 'orange', 
            prefix: 'fa',
            iconColor: 'white',
            shape: 'square'
        });

        var ihtIcon = L.ExtraMarkers.icon({
            prefix: 'fa', 
            markerColor: 'green-light', 
            icon: 'fa-building', 
            iconColor: 'white',
            shape: 'square'
        });

        var routeIcon = L.ExtraMarkers.icon({
            prefix: 'fa', 
            markerColor: 'red', 
            icon: 'fa-location-arrow', 
            iconColor: 'white',
            shape: 'square'
        });

        $.ajax({
          type : "GET",
          async : false,
          global : false,
          url :  root + "index.php/perusahaan/geo",
          dataType : 'json',
          success : function (data) {
            source = data;
            iht_layer = L.geoJson(data, {
                pointToLayer: function(feature, latlng) {
                  return L.marker(latlng, {
                    icon: ihtIcon
                  })
                },
                onEachFeature: function (feature, layer) {

                }
            });
            iht_layer.addTo(map);
          }
        });

        //geolocation
        map.locate({
          watch: true,
          setView: false, 
          maxZoom: 16,
          drawCircle: true,
          follow: true
        });

        lc = L.control.locate({
          position: 'topleft',
          follow: true,
          strings: {
            title: "Lokasi Anda"
          }
        });
        
        map
          .on('startfollowing', function() {
            map.on('dragstart', lc._stopFollowing, lc);
          })
          .on('stopfollowing', function() {
            map.off('dragstart', lc._stopFollowing, lc);
          });

        map.on('locationfound', onLocationFound); 
        
        //layer control
        var baseLayers = {
          "OpenStreetMap": osm,
          "Google ROADMAP": google_roadmap,
          "Google HYBRID": google_hybrid,
          "Google SATELLITE": google_satelit,
          "Esri World Imagery": Esri_WorldImagery,
          "Mapbox Street": mapbox
        };

        var overlays = {
          "Industri": iht_layer
        };
        
        L.control.layers(baseLayers, overlays).addTo(map);

        var sidebar = L.control.sidebar('sidebar').addTo(map);

        // sidebar.open();
    </script>
</body>
</html>
