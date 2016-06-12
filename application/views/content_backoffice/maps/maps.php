</style>
<div class="page-content">
  <div class="header">
    <h2>Peta <strong> IHT</strong></h2>
    <div class="breadcrumb-wrapper">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a>
        </li>
        <li class="active">Peta Persebaran IHT</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
      <div class="panel panel-default map-panel">
        <div class="panel-body">
          <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#tab1_1" data-toggle="tab"><i class="fa fa-home"></i> </a></li>
            <li class=""><a href="#tab1_2" data-toggle="tab"><i class="fa fa-search"></i> </a></li>
          </ul>
          <div class="tab-content p-10">
            <div class="tab-pane fade active in" id="tab1_1">
              <div class="row">
                <div class="col-xs-12">
                  <div class="form-group">
                    <label>Kabupaten</label>
                    <select name="kecamatan" class="form-control form-white" data-style="white" id="kabupaten" data-search="true">
                      <option value="">Pilih Kabupaten</option>
                    </select>
                  </div>
                  <div class="form-group m-t-10" id="search_maps">
                    <label>Daftar Perusahaan</label>
                    <div class="row">
                      <div class="col-xs-12">
                        <table id="result_search_maps_2">
                          <tbody>
                            <tr>

                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="tab1_2">
              <div class="row">
                <div class="col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Pencarian Perusahaan</label>
                    <div class="append-icon">
                      <input type="text" class="form-control form-white" placeholder="Nama Perusahaan..." id="search_perusahaan">
                      <i class="fa fa-spinner fa-pulse" id="search_loader"></i>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-sm btn-success btn-square" id="submit_search_perusahaan"><i class="fa fa-search" id="icon_search_perusahaan"></i><i class="fa fa-spinner" id="icon_loading_search_perusahaan"></i> Cari</button>
                    <button class="btn btn-sm btn-danger btn-square" id="erase_search_perusahaan"><i class="fa fa-trash-o"></i> Hapus</button>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Hasil Pencarian</label>
                    <div class="row">
                      <div class="col-xs-12">
                        <table id="search_result_2">
                          <tbody>
                            <tr>

                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="panel panel-default">
        <div class="panel-body">
          
        </div>
      </div> -->
    </div>
    <div class="col-lg-9">
      <div class="panel panel-default map-panel">
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12">
              <div id="map"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="copyright">
      <p class="pull-left sm-pull-reset">
        <span>Copyright <span class="copyright">©</span> 2015 </span>
        <span>Dinas Perindustrian & Perdagangan</span>.
      </p>
    </div>
  </div>
</div>
<!-- END PAGE CONTENT -->
<script type="text/javascript">
  // isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0
  /**
   * 
   *  Function Declaration
   * 
   */

  function getPopup ( layer, posisi_kita_lat, posisi_kita_lng, layer_lat, layer_lng ) {
    var status = '';
    var jenis_produk_show = '';
    var merek_produk_show = '';
    if ( layer.feature.properties.status != null ) {
      if ( layer.feature.properties.status == 0 ) {
        status = '<span class="c-red">Tidak Aktif</span>';
      }
      else{
        status = '<span class="c-green">Aktif</span>';
      }
    }
    else{
      status = '<span class="c-orange">Tidak Diketahui</span>';
    }

    var lokasiFoto = root + 'assets/images/foto/' + layer.feature.properties.foto + '.JPG';

    $.each(layer.feature.properties.merek_produk, function () {
      merek_produk_show += '<i class="fa fa-caret-right"></i> '+ this.nama_merk_dagang_sudah_registrasi +'<br>';
    })

    $.each(layer.feature.properties.jenis_produk, function () {
      jenis_produk_show += '<i class="fa fa-caret-right"></i> '+ this.nama_produk +' ('+ this.singkatan_produk +')<br>';
    })

    var popupContent = '<div class="row">' + 
                   '<div class="col-sm-12">' + 
                     '<p class="f-18 m-b-10 m-t-0"><strong>' + layer.feature.properties.nama_perusahaan + '</strong></p>' +
                     '<table class="custom-table">' +
                     '<tr><td valign="top" width="100">Alamat</td><td width="10" valign="top"> : </td><td>' + layer.feature.properties.alamat + ', ' + layer.feature.properties.nama_kabupaten + '</td></tr>' +
                     '<tr><td valign="top" width="100">Jenis Produk</td><td width="10" valign="top"> : </td><td>' + jenis_produk_show + '</td></tr>' +
                     '<tr><td valign="top" width="100">Merek</td><td width="10" valign="top"> : </td><td>' + merek_produk_show + '</td></tr>' +
                     '<tr><td valign="top" width="100">Status</td><td width="10" valign="top"> : </td><td>' + status + '</td></tr>' +
                     '<tr><td valign="top" width="100">Jarak Udara</td><td width="10" valign="top"> : </td><td>' + Math.round((jarak / 1000) * 100) / 100 + ' Kilometer</td></tr>' +
                     '<tr>' + 
                        '<td valign="top" width="100">Options</td><td width="10" valign="top"> : </td><td>' + 
                          '<div class="btn-group">' +
                            '<a href="' + root +'index.php/perusahaan/' + layer.feature.properties.id_perusahaan + '" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-search"></i> Detail</a>' +
                            '<div class="btn-group">' +
                              '<a type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">' +
                              '<i class="fa fa-gear"></i> More <i class="fa fa-angle-down"></i>' +
                              '</a>' +
                              '<ul class="dropdown-menu">' +
                                  '<li>' +
                                    '<a href="javascript:void(0)" onclick="ke_lokasi(' + posisi_kita_lat + ',' + posisi_kita_lng + ',' + layer_lat + ',' + layer_lng + ')"><i class="fa fa-location-arrow"></i> Ke Lokasi</a>' +
                                  '</li>' +
                                  '<li>' +
                                    '<a href="http://maps.apple.com/?q=' + layer.feature.properties.latitude + ',' + layer.feature.properties.longitude + '" target="_blank"><i class="fa fa-location-arrow"></i> External Link</a>' +
                                  '</li>' +
                              '</ul>' +
                            '</div>' +
                          '</div>' +
                        '</td>' + 
                      '</tr>' +
                      '<tr><td valign="top" width="100">Foto</td><td width="10" valign="top"> : </td><td><img class="img" src="' + lokasiFoto + '" width="200"></td></tr>' +
                     '</table>' +
                   '</div>' +
                   '</br>' +
                   '</div>';
    
    return popupContent;
    // return '<div class="row">' + 
    //                  '<div class="col-sm-12">' + 
    //                    '<p class="f-18 m-b-0 m-t-0"><strong>' + layer.feature.properties.nama_perusahaan + '</strong></p>' +
    //                    '<p class="f-12 m-t-10 m-b-0"> √&nbsp; &nbsp;' + layer.feature.properties.nama_kabupaten + '</p>' +
    //                    '<p class="f-12 m-t-0 m-b-0"> √&nbsp; &nbsp;' + layer.feature.properties.alamat + '</p>' +
    //                    '<p class="f-12 m-t-0 m-b-0"> √&nbsp; &nbsp; Kecamatan ' + layer.feature.properties.nama_kecamatan + '</p>' +
    //                   '<p class="f-12 m-t-0 m-b-10"> √&nbsp; &nbsp; ' + status + '</p>' +
    //                    '<p class="f-12 m-t-0 m-b-10"> √&nbsp; &nbsp; Jarak Udara ' + Math.round((jarak / 1000) * 100) / 100 + ' Kilometer</p>' +
    //                  '</div>' +
    //                  '</br>' +
    //                  '<div class="col-sm-12">' + 
    //                  '<div class="btn-group">' +
    //                    '<a href="' + root +'index.php/perusahaan/' + layer.feature.properties.id_perusahaan + '" class="btn btn-success btn-md" target="_blank"><i class="fa fa-search"></i> Detail</a>' +
    //                    '<div class="btn-group">' +
    //                      '<a type="button" class="btn btn-success btn-md dropdown-toggle" data-toggle="dropdown">' +
    //                      '<i class="fa fa-gear"></i> More <i class="fa fa-angle-down"></i>' +
    //                      '</a>' +
    //                      '<ul class="dropdown-menu">' +
    //                          '<li>' +
    //                            '<a href="javascript:void(0)" onclick="ke_lokasi(' + posisi_kita_lat + ',' + posisi_kita_lng + ',' + layer_lat + ',' + layer_lng + ')"><i class="fa fa-location-arrow"></i> Ke Lokasi</a>' +
    //                          '</li>' +
    //                          '<li>' +
    //                            '<a href="http://maps.apple.com/?q=' + layer.feature.properties.latitude + ',' + layer.feature.properties.longitude + '" target="_blank"><i class="fa fa-location-arrow"></i> External Link</a>' +
    //                          '</li>' +
    //                      '</ul>' +
    //                    '</div>' +
    //                  '</div>' +
    //                  '</div>' +
    //                  '</div>';
   }

  function onLocationFound(e) {
    var radius = e.accuracy / 2;
    
    if(center == 0 ){
      map.setView(e.latlng, 13);
      center++;
    }

    iht_layer.eachLayer(function (layer) {
      layer_lat_long = layer.getLatLng();
      layer_lat = layer.getLatLng().lat;
      layer_lng = layer.getLatLng().lng;

      // jarak ke point saat ini dalam meter
      var posisi_kita_lat = e.latlng.lat;
      var posisi_kita_lng = e.latlng.lng;

      jarak = layer_lat_long.distanceTo(e.latlng);

      var popupContent = getPopup( layer, posisi_kita_lat, posisi_kita_lng, layer_lat, layer_lng );
      layer.bindPopup(popupContent, popupOptions);
      if(jarak > 30000){
         // layer.setOpacity(0);
         // layer.unbindPopup();
      }
    });
  }

  function ke_lokasi(x_awal, y_awal, x_akhir, y_akhir){
    map.closePopup();
    console.log(x_awal+ ' , ' +y_awal+ ' ; ' +x_akhir + ' , ' + y_akhir)

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
              draggable: false,
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
  }

  function tambah_titik(x, y, id_perusahaan){

    map.panTo(new L.LatLng(x, y));
    map.setZoom(16);

    iht_layer.eachLayer(function (layer) {
      if ( layer.feature.properties.id_perusahaan == id_perusahaan ) {
        console.log(layer.feature.properties)
        layer.openPopup();
      };
    });
  }

  function get_color_tenaga_kerja (jumlah) {
    var color =0;
    var colors = ['transparent' , '#e5f5f9', '#99d8c9', '#2ca25f'];
    if(jumlah >= 1 && jumlah < 5000){
        color = 1;
    }else if(jumlah > 5000 && jumlah <= 10000){
        color = 2;
    }else if(jumlah > 10000){
        color = 3;
    }
    return colors[color];
  }

  function get_color_produksi (jumlah) {
    var color =0;
    var colors = ['transparent' , '#e5f5f9', '#99d8c9', '#2ca25f'];
    if(jumlah >= 1 && jumlah < 1000000){
        color = 1;
    }else if(jumlah > 1000000 && jumlah <= 100000000){
        color = 2;
    }else if(jumlah > 100000000){
        color = 3;
    }
    return colors[color];
  }

  function get_color_perusahaan (jumlah) {
    var color =0;
    var colors = ['transparent' , '#e5f5f9', '#99d8c9', '#2ca25f'];
    if(jumlah >= 1 && jumlah < 25){
        color = 1;
    }else if(jumlah > 25 && jumlah <= 50){
        color = 2;
    }else if(jumlah > 50){
        color = 3;
    }
    return colors[color];
  }

  /**
   * 
   *  Variables Initialization
   * 
   */
  var kabupaten_layer;
  var iht_layer = null;
  var source = null;
  var marker;
  var lingkaran;
  var center = 0;
  var navigasi=null;
  var kecamatan_layer;
  var marker_search='';

  /**
   * 
   *  Layer Styling
   * 
   */
  var sembunyi = {
    color : "transparent",
    weight : 1,
    opacity : 0,
    fillOpacity : 0
  };
  
  var style_kabupaten = {
    color : "white", 
    weight : 1, 
    opacity : 1, 
    fillOpacity  : 0,
    dashArray : 3
  };

  var style_kabupaten_gelap = {
    color : "#000", 
    weight : 1, 
    opacity : 1, 
    fillOpacity  : 0,
    dashArray : 3
  };
  
  var popupOptions = {
    maxWidth : '450',
    minWidth : '250',
    className : 'custom',
    closeOnClick : true
  };

  /**
   * 
   *  Map initialization
   * 
   */
  var southWest = L.latLng(-8.629903118263488, 108.0780029296875),
    northEast = L.latLng(-6.124169589851178, 112.52746582031249),
    bounds = L.latLngBounds(southWest, northEast);

  var map = L.map('map', {
      center: [-7.440198, 110.323170],
      // maxBounds: bounds,
      zoom: 8,
      minZoom:7,
      maxZoom:19,
      fullscreenControl: true,
      fullscreenControlOptions: {
        position: 'topleft'
      }
  });
  // map.fitBounds(bounds);

  var google_roadmap    = new L.Google('ROADMAP');
  var google_hybrid     = new L.Google('HYBRID');
  var google_satelit    = new L.Google('SATELLITE');
  var osm               = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {});
  var Esri_WorldImagery = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}');
  var mapbox            = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6IjZjNmRjNzk3ZmE2MTcwOTEwMGY0MzU3YjUzOWFmNWZhIn0.Y8bhBaUMqFiPrDRW9hieoQ', {
                            maxZoom: 18,
                            id: 'mapbox.streets'
                          });

  map.addLayer(Esri_WorldImagery);

  var legend = L.control({position: 'bottomleft'});

  var locateIcon = L.ExtraMarkers.icon({
      icon: 'fa-map-marker', 
      markerColor: 'blue-dark', 
      prefix: 'fa',
      iconColor: 'white',
      shape: 'square'
  });

  var ihtIconAktif = L.ExtraMarkers.icon({
      prefix: 'fa', 
      markerColor: 'green-light', 
      icon: 'fa-building', 
      iconColor: 'white',
      shape: 'square'
  });

  var ihtIconTidakAktif = L.ExtraMarkers.icon({
      prefix: 'fa', 
      markerColor: 'red', 
      icon: 'fa-ban', 
      iconColor: 'white',
      shape: 'square'
  });

  var ihtIconTidakDiketahui = L.ExtraMarkers.icon({
      prefix: 'fa', 
      markerColor: 'orange', 
      icon: 'fa-question', 
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

  $.getJSON( root + "index.php/kabupaten", function( json ) {
    $.each(json, function( i, item ) {
      $('#kabupaten').append('<option value="'+item.id_kabupaten+'">'+item.nama_kabupaten+'</option>');
    })
  });
  
  $.ajax({
    type : "GET",
    async : false,
    global : false,
    url : root + "index.php/kabupaten/geo",
    dataType : 'json',
    success: function (data) {
      console.log(data);
      // sessionStorage.setItem("kabupaten", JSON.stringify(data));
      kabupaten_layer = L.geoJson(data, {
        style: style_kabupaten,
        onEachFeature: function (feature, layer) {
          // layer.bindPopup(feature.properties.kabupaten);
          // Get bounds of polygon
          var bounds = layer.getBounds();
          // Get center of bounds
          var center = bounds.getCenter();
          // Use center to put marker on map
          //var marker = L.marker(center).addTo(map);
        }
      });
      kabupaten_layer.addTo(map);
    }
  });

  // var kabupaten_layer = omnivore.topojson(root + '/assets/kabupaten_topojson.json')
  //     .addTo(map);

  //     kabupaten_layer.setStyle(style_kabupaten);

  $.ajax({
    type : "GET",
    async : false,
    global : false,
    url : root + "index.php/perusahaan/geo",
    dataType : 'json',
    success : function (data) {
      source = data;
      iht_layer = L.geoJson(data, {
        pointToLayer: function(feature, latlng) {
          if ( feature.properties.status != null ) {
            if ( feature.properties.status == 0 ) {
              return L.marker(latlng, {
                          icon: ihtIconTidakAktif
                      })
            }else{
              return L.marker(latlng, {
                          icon: ihtIconAktif
                      })
            }
          }else{
            return L.marker(latlng, {
                          icon: ihtIconTidakDiketahui
                      })
          }
        },
        onEachFeature: function (feature, layer) {
          var status = '';
          var jenis_produk_show = '';
          var merek_produk_show = '';
          if ( feature.properties.status != null ) {
            if ( feature.properties.status == 0 ) {
              status = '<span class="c-red">Tidak Aktif</span>';
            }
            else{
              status = '<span class="c-green">Aktif</span>';
            }
          }else{
            status = '<span class="c-orange">Tidak Diketahui</span>';
          }
          var lokasiFoto = root + 'assets/images/foto/' + feature.properties.foto + '.JPG';
          $.each(feature.properties.jenis_produk, function () {
            jenis_produk_show += '<i class="fa fa-caret-right"></i> '+ this.nama_produk +' ('+ this.singkatan_produk +')<br>';
          })
          $.each(feature.properties.merek_produk, function () {
            merek_produk_show += '<i class="fa fa-caret-right"></i> '+ this.nama_merk_dagang_sudah_registrasi +'<br>';
          })
          var popupContent = '<div class="row">' + 
                    '<div class="col-sm-12">' + 
                      '<p class="f-18 m-b-10 m-t-0"><strong>' + feature.properties.nama_perusahaan + '</strong></p>' +
                      '<table class="custom-table">' +
                      '<tr><td valign="top" width="100">Alamat</td><td width="10" valign="top"> : </td><td>' + feature.properties.alamat + ', ' + feature.properties.nama_kabupaten + '</td></tr>' +
                      '<tr><td valign="top" width="100">Jenis Produk</td><td width="10" valign="top"> : </td><td>' + jenis_produk_show + '</td></tr>' +
                      '<tr><td valign="top" width="100">Merek</td><td width="10" valign="top"> : </td><td>' + merek_produk_show + '</td></tr>' +
                      '<tr><td valign="top" width="100">Status</td><td width="10" valign="top"> : </td><td>' + status + '</td></tr>' +
                      '<tr><td valign="top" width="100">Options</td><td width="10" valign="top"> : </td><td><a href="' + root + 'index.php/perusahaan/' + feature.properties.id_perusahaan + '" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-search"></i> Detail</a></td></tr>' +
                      '<tr><td valign="top" width="100">Foto</td><td width="10" valign="top"> : </td><td><img class="img" src="' + lokasiFoto + '" width="200">' + '</td></tr>' +
                      '</table>' +
                    '</div>' +
                    '</br>' +
                    '</div>';

          layer.bindPopup(popupContent, popupOptions);
        }
      });
      iht_layer.addTo(map);
    }
  });

  var baseLayers = {
    "Google Roadmap": google_roadmap,
    "Google Hybrid": google_hybrid,
    "Google Satellite": google_satelit,
    "Open Street Map": osm,
    "ESRI World Imagery": Esri_WorldImagery,
    "Mapbox Street": mapbox
  };
  
  var overlays = {
    "Industri": iht_layer,
    "Kabupaten": kabupaten_layer
  };
  
  L.control.layers(baseLayers, overlays,{
    position : 'topright'
  }).addTo(map);

  legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info-legend'),
    // warna_total = ['#ffffff' , '#fef0d9', '#fdcc8a', '#fc8d59', '#e34a33', '#b30000'];
    warna_total = [];
    labels = [];
    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < warna_total.length; i++) {
      div.innerHTML += '<i style="background:' + warna_total[i] + '"></i> ' + labels[i] + '<br>';
    }
    return div;
  };

  legend.addTo(map);

  L.control.scale({
    position : 'bottomright',
    metric : true,
    imperial : false
  }).addTo(map);
  
  lc = L.control.locate({
    position : 'topleft',
    follow : true,
    strings : {
      title : "Lokasi Anda",
      popup: "Anda berada di radius {distance} {unit} dari titik ini"
    },
    markerClass : L.marker,
    markerStyle : {icon: locateIcon},
    keepCurrentZoomLevel : true
  }).addTo(map);

  map
    .on('startfollowing', function() {
      map.on('dragstart', lc._stopFollowing, lc);
    })
    .on('stopfollowing', function() {
        map.off('dragstart', lc._stopFollowing, lc);
    });

  map.on('locationfound', onLocationFound);
  
  map.on('moveend', function() { 
       console.log(map.getBounds());
  });

  map.on('baselayerchange', function(e) {
    console.log(e.name);

    if ( e.name == 'Google Roadmap' || e.name == 'Open Street Map' || e.name == 'Mapbox Street') {
      kabupaten_layer.eachLayer(function (layer) {
        layer.setStyle(style_kabupaten_gelap);
      });
    }else{
      kabupaten_layer.eachLayer(function (layer) {
        layer.setStyle(style_kabupaten);
      });
    }

  });
  
  //ganti kabupaten
  $('#search_maps').hide();
  $('#kabupaten').change(function(){
    $('#search_maps').show();
    $('#result_search_maps_2 tbody').empty();
    map.setZoom(8);
    if(kecamatan_layer != undefined){
      map.removeLayer(kecamatan_layer);
    }
    
    kabupaten_layer.eachLayer(function (layer) {
      // Get bounds of polygon
      var bounds = layer.getBounds();
      // Get center of bounds
      var center = bounds.getCenter();
      if(layer.feature.properties.id_kabupaten == $('#kabupaten').val()){

        iht_layer.eachLayer(function (layer) {
          layer.closePopup();
          if( layer.feature.properties.id_kabupaten != $('#kabupaten').val() ){
            
            layer.setOpacity(0);

          }
          else{
            // console.log(layer.feature.properties.nama_perusahaan);
            // $('#result_search_maps').append('<li><a href="javascript:void(0)" onclick="tambah_titik(' + layer.feature.properties.latitude + ', ' + layer.feature.properties.longitude + ', ' + layer.feature.properties.id_perusahaan + ')">' + layer.feature.properties.nama_perusahaan + '</a></li>');
            $('#result_search_maps_2 tbody').append('<tr><td width="150">' + layer.feature.properties.nama_perusahaan + '</td><td><a href="javascript:void(0)" style="color:#337ab7" class="btn btn-sm btn-default btn-square" onclick="tambah_titik(' + layer.feature.properties.latitude + ', ' + layer.feature.properties.longitude + ', ' + layer.feature.properties.id_perusahaan + ')"><i class="fa fa-location-arrow fa-border"></i></a></td></tr>');
            layer.setOpacity(1);

          }

        });

        map.panTo(center);
        
        layer.setStyle(style_kabupaten);

      }
      else{
        layer.setStyle(sembunyi);                                 
      }

      if($('#kabupaten').val()==""){
        $('#result_search_maps_2 tbody').empty();
        $('#search_maps').hide();
        map.closePopup();
        layer.setStyle(style_kabupaten);
        iht_layer.eachLayer(function (layer) {
          layer.setOpacity(1);    
        })
      }
    });
  })

  $('.leaflet-bottom.leaflet-left').hide();
  
  $('.leaflet-bar-part.leaflet-bar-part-single').click(function () {
    iht_layer.eachLayer(function (layer) {
      layer.setOpacity(1);

      var status = '';
      var jenis_produk_show = '';
      var merek_produk_show = '';
      if ( layer.feature.properties.status != null ) {
        if ( layer.feature.properties.status == 0 ) {
          status = '<span class="c-red">Tidak Aktif</span>';
        }
        else{
          status = '<span class="c-green">Aktif</span>';
        }
      }else{
        status = '<span class="c-orange">Tidak Diketahui</span>';
      }
      var lokasiFoto = root + 'assets/images/foto/' + layer.feature.properties.foto + '.JPG';
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
                  '<tr><td valign="top" width="100">Alamat</td><td width="10" valign="top"> : </td><td>' + layer.feature.properties.alamat + ', ' + layer.feature.properties.nama_kabupaten + '</td></tr>' +
                  '<tr><td valign="top" width="100">Jenis Produk</td><td width="10" valign="top"> : </td><td>' + jenis_produk_show + '</td></tr>' +
                  '<tr><td valign="top" width="100">Merek</td><td width="10" valign="top"> : </td><td>' + merek_produk_show + '</td></tr>' +
                  '<tr><td valign="top" width="100">Status</td><td width="10" valign="top"> : </td><td>' + status + '</td></tr>' +
                  '<tr><td valign="top" width="100">Foto</td><td width="10" valign="top"> : </td><td><img class="img" src="' + lokasiFoto + '" width="200">' + '</td></tr>' +
                  '</table>' +
                '</div>' +
                '</br>' +
                '</div>';

      layer.bindPopup(popupContent, popupOptions);
    });
  })
  
  legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info-legend')
    div.innerHTML += judul;
    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < warna_total.length; i++) {
      div.innerHTML += '<i style="background:' + warna_total[i] + '"></i> ' + labels[i] + '<br>';
    }
    return div;
  };

  $('#resume').hide();
  kabupaten_layer.on('click', function(e) {
    map.closePopup();
  })

  $('#search_loader').hide();
  $('#icon_loading_search_perusahaan').hide();
  $('#submit_search_perusahaan').click(function ( event ) {
    if ( $('#search_perusahaan').val() != '') {
      $.ajax({
        type : "GET",
        async : true,
        global : false,
        url : root + "index.php/perusahaan/search/" + $('#search_perusahaan').val() +'',
        dataType : 'json',
        beforesend: function () {
          $('#icon_search_perusahaan').hide();
          $('#icon_loading_search_perusahaan').show();
        },
        success: function (data) {
          $('#search_result_2 tbody').empty();
          $.each(data, function (i, item) {
            $('#search_result_2 tbody').append('<tr><td width="150">' + item.nama_perusahaan + '</td><td><a href="javascript:void(0)" style="color:#337ab7" class="btn btn-sm btn-default btn-square" onclick="tambah_titik(' + item.latitude + ', ' + item.longitude + ', ' + item.id_perusahaan + ')"><i class="fa fa-location-arrow fa-border"></i></a></td></tr>');
            // $('#result_search_maps_2 tbody').append('');
            iht_layer.eachLayer(function (layer) {
              // layer.closePopup();
              if ( layer.feature.properties.nama_perusahaan == item.nama_perusahaan ) {
                // console.log(layer.feature.properties.nama_perusahaan);
                // layer.openPopup();
                // layer.setOpacity(0);
              };
            });

          })
        },
        complete: function () {
          $('#icon_search_perusahaan').show();
          $('#icon_loading_search_perusahaan').hide();
        }
      });
    }else{
      $('#search_result_2 tbody').empty();
    }

  })
  
  $('#erase_search_perusahaan').click(function () {
    $('#search_result_2 tbody').empty();
    $('#search_perusahaan').val('');
    map.closePopup();
  })
  
  // kabupaten_layer.eachLayer(function (layer) {
  //   console.log(layer);
  // })
</script>