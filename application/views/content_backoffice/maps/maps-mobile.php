<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="IHT">
    <meta name="author" content="Disperindag">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
    <title>IHT</title>
    <link href="<?php echo base_url(); ?>assets/css/leaflet.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ui.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url(); ?>assets/css/L.Control.Geonames.css" rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>assets/css/Control.FullScreen.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet.awesome-markers.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet-routing-machine.css" />
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style_locate.css" /> -->
    <!-- END PAGE STYLE -->
    <script type="text/javascript">
        var root = '<?php echo base_url() ?>';
    </script>
    <script src="<?php echo base_url(); ?>assets/js/leaflet.js"></script>
    <script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
    <script src="<?php echo base_url(); ?>assets/js/google-leaf.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/Control.FullScreen.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/leaflet.awesome-markers.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/L.Control.Locate.js" ></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/leaflet-routing-machine.js"></script>

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

        /* css to customize Leaflet default styles  */
        .custom .leaflet-popup-tip,
        .custom .leaflet-popup-content-wrapper {
            font-family: 'Open Sans', Helvetica, sans-serif !important;
            background: #fffff;
            color: #000;
        }
    </style>
  </head>
<body>
    <div class="row">
      <div class="col-xs-12">
        <div class="form-group">
          <div class="col-xs-12">
            <input type="text" id="search_perusahaan" class="form-control input-sm">
          </div>
        </div>
      </div>
    </div>
    <div id="map" class="sidebar-map"></div>

    <!-- END PRELOADER -->
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
          marker = new L.Marker(e.latlng,{icon: icon_orang});
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
            var popupContent = '<div class="row">' + 
                '<div class="col-sm-12">' + 
                  '<p class="f-18 m-b-0 m-t-0"><strong>' + layer.feature.properties.nama_perusahaan + '</strong></p>' +
                  '<p class="f-12 m-t-10 m-b-0"> √&nbsp; &nbsp;' + layer.feature.properties.nama_kabupaten + '</p>' +
                  '<p class="f-12 m-t-0 m-b-0"> √&nbsp; &nbsp;' + layer.feature.properties.alamat + '</p>' +
                  '<p class="f-12 m-t-0 m-b-0"> √&nbsp; &nbsp; Kecamatan ' + layer.feature.properties.nama_kecamatan + '</p>' +
                  '<p class="f-12 m-t-0 m-b-10"> √&nbsp; &nbsp; Jarak Udara ' + Math.round((jarak / 1000) * 100) / 100 + ' Kilometer</p>' +
                '</div>' +
                '</br>' +
                '<div class="col-sm-12">' + 
                  '<a href="' + root +'index.php/mobile/perusahaan/' + layer.feature.properties.id_perusahaan + '" class="btn btn-success btn-sm m-b-0 text-right" target="_blank"><i class="fa fa-search"></i> Detail</a>' +
                  '<a href="javascript:void(0)" onclick="ke_lokasi(' + posisi_kita_lat + ',' + posisi_kita_lng + ',' + layer_lat + ',' + layer_lng + ')" class="btn btn-warning btn-sm m-b-0 text-right"><i class="fa fa-location-arrow"></i> Ke Lokasi</a>' +
                  '<a href="http://maps.apple.com/?q=' + layer.feature.properties.ye + ',' + layer.feature.properties.xe + '" class="btn btn-warning btn-sm m-b-0 text-right" target="_blank"><i class="fa fa-location-arrow"></i> Ke Lokasi (Google Maps)</a>' +
                '</div>' +
                '</div>';
            layer.bindPopup(popupContent, popupOptions);
            // layer.bindPopup(layer.feature.properties.nama_perusahaan+'<br><a href="#" onclick="ke_lokasi('+posisi_kita_lat+','+posisi_kita_lng+','+layer_lat+','+layer_lng+')">Ke Lokasi</a><br><a href="http://maps.apple.com/?q='+layer.feature.properties.ye+','+layer.feature.properties.xe+'">Ke Lokasi(googlemaps)</a></br>Jarak Udara : '+jarak/1000+' Kilometer');
             if(jarak > 30000){
               // layer.setOpacity(0);
            }
          });
        }

        function ke_lokasi(x_awal, y_awal, x_akhir, y_akhir){
          map.closePopup();
          if(navigasi!=null){
            navigasi.spliceWaypoints(navigasi.getWaypoints().length - 1, 1, L.latLng(x_akhir, y_akhir));   
          }
          else{
            navigasi =  L.Routing.control({
              waypoints: [L.latLng(x_awal, y_awal), L.latLng(x_akhir, y_akhir)]
            });
            navigasi.addTo(map);
            $('.leaflet-routing-container').append('<a href="#" id="tutup_navigasi" onclick="tutup_navigasi()">TUTUP</a>');
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
            maxZoom:17,
            fullscreenControl: true,
            fullscreenControlOptions: {
              position: 'topleft'
            }
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
          maxWidth : '500',
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

        $.ajax({
          type : "GET",
          async : false,
          global : false,
          url :  root + "index.php/perusahaan/geo",
          dataType : 'json',
          success : function (data) {
            source = data;
            iht_layer = L.geoJson(data, {
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
        }).addTo(map);
        
        map
          .on('startfollowing', function() {
            map.on('dragstart', lc._stopFollowing, lc);
          })
          .on('stopfollowing', function() {
            map.off('dragstart', lc._stopFollowing, lc);
          });

        map.on('locationfound', onLocationFound); 
        
        var icon_orang = L.AwesomeMarkers.icon({
          icon: 'paper-plane', 
          markerColor: 'orange', 
          prefix: 'fa', 
          spin:false
        });
        
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
    </script>


</body>
</html>
