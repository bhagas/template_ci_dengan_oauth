</style>
<div class="page-content">
  <div class="header">
    <h2>Peta Tematik<strong> IHT</strong></h2>
    <div class="breadcrumb-wrapper">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a>
        </li>
        <li class="active">Peta Tematik IHT</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label>Tahun </label>
                <select class="form-control form-white" id="tahun">
                  <?php for ($i=2010; $i < 2020; $i++) { 
                  ?>
                    <option value="<?php echo $i ?>" <?php if ( $i == date("Y")): ?>
                      selected
                    <?php endif ?>><?php echo $i ?></option>
                  <?php
                    } 
                  ?>
                </select>
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-square" id="submit_tematik"><i class="fa fa-search" id="search"></i> Cari</button>
                <i class="fa fa-spinner fa-2x fa-spin" id="loading_tematik"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <!-- <label>Tematik</label>
                <select class="form-control form-white" data-style="white" id="thematic">
                  <option value="">Pilih Tematik</option>
                  <option value="produksi">Produksi</option>
                  <option value="tenaga_kerja">Tenaga Kerja</option>
                  <option value="jumlah_perusahaan">Jumlah Perusahaan</option>
                </select> -->
                <label class="control-label" >Tematik</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="tematik" value="jumlah_perusahaan">
                    Jumlah Perusahaan
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="tematik" value="tenaga_kerja">
                    Jumlah Tenaga Kerja
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="tematik" value="produksi">
                    Volume Produksi
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-default map-panel" id="resume">
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12">
              <br>
              <div class="col-xs-12">
                <div class="form-group">
                  <label id="judul"></label><br>
                  <span id="kabkota"></span>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label id="tematik"></label><br>
                  <span id="tematik_value"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
  $('#loading_tematik').hide();
  $('#loading_tematik').ajaxStop(function () {
    $(this).show();
    // alert('Peta Tematik Telah Dirubah. Silahkan Pilih Menu Tematik.');
  })
  /**
   * 
   *  Variables Initialization
   * 
   */
  var kabupaten_layer = null;
  var iht_layer = null;
  var source = null;
  var marker;
  var lingkaran;
  var center = 0;
  var navigasi=null;
  var kecamatan_layer;
  var marker_search='';
  var tahun_sekarang = (new Date).getFullYear();

  /**
   * 
   *  Function Declaration
   * 
   */

  function set_kabupaten_layer ( tahun ) {
    if ( kabupaten_layer != undefined ){
      map.removeLayer( kabupaten_layer );
    }

    $.ajax({
      type : "GET",
      async : true,
      global : false,
      url : root + "index.php/kabupaten/geo_tematik?tahun="+tahun,
      // dataType : 'json',
      beforeSend:function () {
        console.log('sending');
        $('#loading_tematik').show();
      },
      success: function (data) {
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
      },
      complete:function () {
        console.log('send complete');
        $('#loading_tematik').hide();
        // $('#loading_tematik').show();
        // alert('Peta Tematik Telah Dirubah. Silahkan Pilih Menu Tematik.');
      },
      error:function (xhr) {
        console.log(xhr.statusText + xhr.responseText);
        alert('Terjadi Kesalahan. Silahkan Periksa Koneksi Internet Anda.');
      }
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

  /**
   * 
   *  Map initialization
   * 
   */
  var southWest = L.latLng(-8.629903118263488, 108.0780029296875),
    northEast = L.latLng(-6.124169589851178, 112.52746582031249),
    bounds = L.latLngBounds(southWest, northEast);

  var map = L.map('map', {
      // center: [-7.440198, 110.323170],
      maxBounds: bounds,
      zoom: 8,
      minZoom:7,
      maxZoom:17,
      fullscreenControl: true,
      fullscreenControlOptions: {
        position: 'topleft'
      }
  });
  map.fitBounds(bounds);

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
  
  $('#resume').hide();

  set_kabupaten_layer( tahun_sekarang );

  $('#submit_tematik').click(function (event) {
      event.preventDefault();
      var tahun_cari = $('#tahun').val();
      // $('#searching').show();
      set_kabupaten_layer( tahun_cari );
      $('input:radio[name=tematik]').removeAttr('checked');

  })

  var baseLayers = {
    "Google Roadmap": google_roadmap,
    "Google Hybrid": google_hybrid,
    "Google Satellite": google_satelit,
    "Open Street Map": osm,
    "ESRI World Imagery": Esri_WorldImagery,
    "Mapbox Street": mapbox
  };
  
  var overlays = {
    // "Industri": iht_layer,
    // "Kabupaten": kabupaten_layer
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

  $('.leaflet-bottom.leaflet-left').hide();
  $('input:radio[name=tematik]').click(function(){
      //ambil desa list
      kategori = $('input:radio[name=tematik]:checked').val();
      $('.leaflet-bottom.leaflet-left').show();
      legend.removeFrom(map);
      warna_total = ['transparent' , '#e5f5f9', '#99d8c9', '#2ca25f'];
      
      kabupaten_layer.eachLayer(function (layerc) {
        if(kategori == 'produksi'){
          var jumlah_produksi = layerc.feature.properties.jumlah_produksi;
          warna = get_color_produksi(jumlah_produksi)
          judul = '<h4>Jumlah Produksi</h4>';
          labels = ['Tidak Ada','< 1jt batang', '> 10jt & < 100jt batang', '> 100jt batang'];
          // warna_total = ['transparent' , '#fef0d9', '#fdcc8a', '#fc8d59'];
        }
        else if(kategori == 'tenaga_kerja'){
          var jumlah_tenaga_kerja = parseInt(layerc.feature.properties.jumlah_tenaga_kerja.fpria) + parseInt(layerc.feature.properties.jumlah_tenaga_kerja.fwanita);  
          warna = get_color_tenaga_kerja(jumlah_tenaga_kerja)
          judul = '<h4>Jumlah Tenaga kerja</h4>';
          labels = ['Tidak Ada','< 5000', '> 5000 & < 10000', '> 10000'];
          // warna_total = ['transparent' , '#fee0d2', '#fc9272', '#de2d26'];
          
        }
        else if(kategori == 'jumlah_perusahaan'){
          var jumlah_perusahaan = layerc.feature.properties.jumlah_perusahaan;
          warna = get_color_perusahaan(jumlah_perusahaan)
          judul = '<h4>Jumlah Perusahaan</h4>';
          labels = ['Tidak Ada','< 25', '> 25 & < 50', '> 50']; 
          // warna_total = ['transparent' , '#fc8d59', '#e34a33', '#b30000']; 
        }
        else if(kategori == ''){
          judul = '';
          labels = ['','', '', ''];
          warna_total = ['','', '', ''];
          warna = get_color_tenaga_kerja(0)
          $('.leaflet-bottom.leaflet-left').hide();
          // legend.removeFrom(map);
        }   
          
        var warna_kawasan = {
          fillColor: warna,
          fillOpacity  : 0.7
        };
        
        layerc.setStyle(warna_kawasan);
      })
      legend.addTo(map);

      kabupaten_layer.on('mouseover', function(e) {
        kategori = $('input:radio[name=tematik]:checked').val();

        $('#judul').text( 'Kabupaten / Kota' );
        $('#kabkota').text(e.layer.feature.properties.nama_kabupaten);

        if ( kategori == '' ) {
          $('#resume').hide();
        };
        
        if ( kategori == 'produksi' ) {
          $('#resume').show();
          var jumlah_produksi = numeral(e.layer.feature.properties.jumlah_produksi).format('0,0');
          $('#tematik').text('Volume Produksi');
          if ( jumlah_produksi == 0 ) {
            $('#tematik_value').text('Tidak Ada');
          }else{
            $('#tematik_value').text(jumlah_produksi + ' Batang / Tahun');
          }
        };

        if ( kategori == 'tenaga_kerja' ) {
          $('#resume').show();
          var total_orang = parseInt(e.layer.feature.properties.jumlah_tenaga_kerja.fpria) + parseInt(e.layer.feature.properties.jumlah_tenaga_kerja.fwanita);
          
          $('#tematik').text('Jumlah Tenaga Kerja');
          
          if ( isNaN(total_orang) ) {
            total_orang = 0;
            $('#tematik_value').text('Tidak Ada');
          }else{
            var tenaga_kerja = numeral(total_orang).format('0,0');
            $('#tematik_value').text(tenaga_kerja + ' Orang');
          }
          
        };

        if ( kategori == 'jumlah_perusahaan' ) {
          $('#resume').show();
          var jumlah_perusahaan = numeral(e.layer.feature.properties.jumlah_perusahaan).format('0,0');
          $('#tematik').text('Jumlah Perusahaan');
          
          if ( jumlah_perusahaan == 0 ) {
            $('#tematik_value').text('Tidak Ada');
          }else{
            $('#tematik_value').text(jumlah_perusahaan + ' Perusahaan');
          }
        };

      });

      kabupaten_layer.on('mouseout', function(e){
        $('#resume').hide();
        $('#tematik').text('');
        $('#tematik_value').text('');
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

  // $('#resume').hide();
  // kabupaten_layer.on('click', function(e) {
  //   alert('test')
  // })

  
</script>