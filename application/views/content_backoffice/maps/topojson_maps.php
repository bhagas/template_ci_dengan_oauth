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
    <div class="col-lg-12">
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
  var map = L.map('map').setView([-7.416942257739026, 109.259033203125], 9);
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

  L.TopoJSON = L.GeoJSON.extend({  
    addData: function(jsonData) {    
      if (jsonData.type === "Topology") {
        for (key in jsonData.objects) {
          geojson = topojson.feature(jsonData, jsonData.objects[key]);
          L.GeoJSON.prototype.addData.call(this, geojson);
        }
      }    
      else {
        L.GeoJSON.prototype.addData.call(this, jsonData);
      }
    }  
  });

  $.getJSON(root + '/assets/kabupaten_topojson.json')
    .done(addTopoData);

  var colorScale = chroma  
    .scale(['#e5f5f9', '#2ca25f'])
    .domain([0,1]);

  var fillColor = colorScale(0.25).hex();  

  var topoLayer = new L.TopoJSON();

  function addTopoData(topoData){  
    topoLayer.addData(topoData);
    topoLayer.addTo(map);
    topoLayer.eachLayer(handleLayer);
  }

  function handleLayer (layer) {
    var randomValue = Math.random(),
        fillColor = colorScale(randomValue).hex();

    layer.setStyle({
        fillColor : fillColor,
        fillOpacity: 0.7,
        // stroke : false,
        color:'#555',
        weight:1,
        opacity:0.5
      });

    console.log(layer.feature.properties.nama_kabupaten);
      // layer.on({
      //   mouseover: enterLayer,
      //   mouseout: leaveLayer
      // });
  }

  // console.log(topoLayer)
</script>