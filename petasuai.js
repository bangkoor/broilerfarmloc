// Base map
var osmLayer = new ol.layer.Tile({source: new ol.source.OSM()});

// Census map layer
var wmsLayer = new ol.layer.Image({
  source: new ol.source.ImageWMS({
    url: 'http://localhost:8080/geoserver/wms',
    params: {'LAYERS': 'broilerfarmloc:kesesuaian'}
  }),
  opacity: 0.6
});

// layer batas
var wmsLayer3 = new ol.layer.Image({
  source: new ol.source.ImageWMS({
    url: 'http://localhost:8080/geoserver/wms',
    params: {'LAYERS': 'broilerfarmloc:desa_central'}
  }),
  opacity: 0.6
});

// Boundary map layer
var wmsLayer1 = new ol.layer.Image({
  source: new ol.source.ImageWMS({
    url: 'http://localhost:8080/geoserver/wms',
    params: {'LAYERS': 'broilerfarmloc:desa'}
  }),
  opacity: 0.6
});

// Label layer
 var wmsLayer2 = new ol.layer.Image({
  source: new ol.source.ImageWMS({
    url: 'http://localhost:8080/geoserver/wms',
    params: {'LAYERS': 'lampung2010:lampunglabel'}
  }),
  opacity: 0.6
});

// Map object
olMap = new ol.Map({
  target: 'map',
  renderer: ol.RendererHint.CANVAS,
  layers: [wmsLayer, wmsLayer1, wmsLayer3],
  view: new ol.View2D({
    center: [11878619.94363, -718494.127158],
    zoom: 13
  })
});

// Create an ol.Overlay with a popup anchored to the map
var popup = new ol.Overlay({
  element: $('#popup')
});
olMap.addOverlay(popup);

// Handle map clicks to send a GetFeatureInfo request and open the popup
olMap.on('singleclick', function(evt) {
  olMap.getFeatureInfo({
    pixel: evt.getPixel(),
    success: function (info) {
      popup.setPosition(evt.getCoordinate());
      $('#popup')
        .popover({content: info.join('')})
        .popover('show');
      // Close popup when user clicks on the 'x'
      $('.popover-title').click(function() {
        $('#popup').popover('hide');
      });
    }
  });
});

//Layer switcher
function changeLayerStatus(layerName, visibility) {
    var layers = map.getLayersByName(layerName);
    var layer = layers[0];

    if(!layer) {
        return;
    }

    layer.setVisibility(visibility);
}