Number.prototype.toRad = function() {
    return this * Math.PI / 180;
};

var JacoOilMap = (function () {

    var jacoMapInstance;

    function create() {

        var $filterStationsDropdown;
        var $infoWindowTerminalDropdown;
        var $filterCheckboxStation;
        var $filterCheckboxTerminal;
        var $filterCheckboxAerial;
        var $filterCheckboxPipeline;
        var $resultsList;
        var $resultsLabel;
        var $resultsListContainer;
        var $resultsStartSearch;
        var $resultsInput;
        var $resultsReset;
        var $resultsInputGoButton;
        var $resultsElementTemplate;
        var $mapLegendRetailers;
        var $mapLegendDistributors;
        var $mapLegendInstallers;
        var $mapLegendRetailersTooltip;
        var $mapLegendDistributorsTooltip;
        var $mapLegendInstallersTooltip;

        var markersArray = [];
        var markersRawArray = [];
        var matchingLocationsArray = [];
        var searchLocationsArray = [];
        var mapObject = null;
        var mapInfoWindowObject = null;
        var markersCluster = null;
        var mapAutoComplete = null;
        var hasSearchResults = false;
        var mapSearchDistance = 100;
        var cookieName = "jacoSearch";
        var currentSearchZoomLevel = 10;
        var aerialDataArray = [];
        var pipelineDataArray = [];
        var aerialMapFeatures = [];
        var pipelineMapFeatures = [];
        var productsMapping = {
            "NOLEAD 1": "NOLEAD",
            "MIDGRADE 89": "MIDGRADE",
            "PREMIUM 91": "PREMIUM",
            "CLEAR CARB DIESEL 2": "CLEAR CARB DIESEL"
        };
        var offsetStations = [3366, 3340, 7707, 7775, 8891, 9920, 9925, 9906];

        function init() {
            _setElements();
            _setDefaults();
            _setBinds();
        }

        function setMapInfoWindow(mapInfoWindow) {
            mapInfoWindowObject = mapInfoWindow;
        }

        function setMarkers(markers) {
            markersArray = markers;
        }

        function setMarkersRawData(markersRaw) {
            markersRawArray = markersRaw;
        }

        function loadDefaultData() {
            var locationsInCookie = _checkForExistingCookie();

            if (locationsInCookie === false) {
                matchingLocationsArray = $.map(markersRawArray, function(value, index) {
                    value.resultsId = index;
                    value.isStation = (typeof value["stationId"] !== "undefined" && value["stationId"] > 0)? true: false;
                    value.isTerminal = (typeof value["terminalId"] !== "undefined" && value["terminalId"] > 0)? true: false;
                    return [value];
                });
            }

            if(matchingLocationsArray.length > 0) {
                for (var i = 0; i < matchingLocationsArray.length; i++) {
                    matchingLocationsArray[i].visible = true;
                }
            }

            _updateSearchListResults();
            _updateStationsFilterDropdown();
        }

        function setMapObject(map) {
            mapObject = map;
        }

        function setAerialData(aerialData) {
            aerialDataArray.push(aerialData);
            toggleAerialOverlay();
        }

        function setPipelineData(aerialData) {
            pipelineDataArray.push(aerialData);
            togglePipelineOverlay();
        }

        function isOffsetStation(stationId) {
            return offsetStations.includes(stationId);
        }

        function setMapAutoComplete(autocomplete) {
            mapAutoComplete = autocomplete;
        }

        function setMarkersCluster(cluster) {
            markersCluster = cluster;
        }

        function parseSearchResults(lat, lng, resetResults) {
            if(typeof resetResults !== "undefined" && resetResults === true){
                searchLocationsArray = [];
                hasSearchResults = false;
                loadDefaultData();
                _updateSearchListResults();
            }else {
                _getListOfMatchingLocations(lat, lng)
            }
        }

        function toggleAerialOverlay(){
            var showOverlay = $filterCheckboxAerial.is(':checked');
            if(showOverlay === true){
                if(aerialDataArray.length > 0){
                    var tempData = {};
                    aerialMapFeatures = [];
                    for(var i = 0; i < aerialDataArray.length; i++){
                        tempData = mapObject.data.addGeoJson(aerialDataArray[i]);
                        aerialMapFeatures.push(tempData);
                    }
                }

                mapObject.data.addListener('click', function(event) {
                    var feat = event.feature;
                    var html = "<b>"+feat.getProperty('Name')+"</b><br>"+feat.getProperty('description');
                    // html += "<br><a class='normal_link' target='_blank' href='"+feat.getProperty('link')+"'>link</a>";
                    mapInfoWindowObject.setContent(html);
                    mapInfoWindowObject.setPosition(event.latLng);
                    mapInfoWindowObject.setOptions({pixelOffset: new google.maps.Size(0,-34)});
                    mapInfoWindowObject.open(mapObject);
                });

            }else{
                if(aerialMapFeatures.length > 0) {
                    // for (var i = 0; i < 15; i++) {
                    for (var i = 0; i < 19; i++) {
                        mapObject.data.remove(mapObject.data.getFeatureById(i+""));
                    }
                    aerialMapFeatures = [];
                }
            }
        }

        function togglePipelineOverlay(){
            var showOverlay = $filterCheckboxPipeline.is(':checked');
            if(showOverlay === true){
                if(pipelineDataArray.length > 0){
                    var tempData = {};
                    pipelineMapFeatures = [];
                    for(var i = 0; i < pipelineDataArray.length; i++){
                        tempData = mapObject.data.addGeoJson(pipelineDataArray[i]);
                        pipelineMapFeatures.push(tempData);

                        for (var i = 0, length = tempData.length; i < length; i++) {
                            var feature = tempData[i];
                            if (feature.getProperty('icon')) {
                                mapObject.data.setStyle(function(feature) {
                                    return {
                                        fillColor: 'green',
                                        strokeWeight: 1,
                                        clickable: true,
                                        icon: "images/factory-pin.png"
                                    };
                                });
                            }
                        }
                    }
                }

                mapObject.data.addListener('click', function(event) {
                    var feat = event.feature;
                    var html = "<b>"+feat.getProperty('Name')+"</b>";
                    // html += "<br><a class='normal_link' target='_blank' href='"+feat.getProperty('link')+"'>link</a>";
                    mapInfoWindowObject.setContent(html);
                    mapInfoWindowObject.setPosition(event.latLng);
                    mapInfoWindowObject.setOptions({pixelOffset: new google.maps.Size(0,-34)});
                    mapInfoWindowObject.open(mapObject);
                });

            }else{
                if(pipelineMapFeatures.length > 0) {
                    for (var i = 19; i < 64; i++) {
                        mapObject.data.remove(mapObject.data.getFeatureById(i+""));
                    }
                    pipelineMapFeatures = [];
                }
            }
        }

        function filterMarkersByCheckbox(){
            if(matchingLocationsArray.length < 1){
                loadDefaultData();
            }

            var isStation = $filterCheckboxStation.is(':checked');
            var isTerminal = $filterCheckboxTerminal.is(':checked');

            if(isStation === true && isTerminal === true){
                if(hasSearchResults === false) {
                    loadDefaultData();
                }
                isStation = true;
                isTerminal = true;
            }

            if(isStation === false && isTerminal === false){
                if(hasSearchResults === false) {
                    loadDefaultData();
                    isStation = false;
                    isTerminal = false;
                }
            }

            if(hasSearchResults === true){
                matchingLocationsArray = searchLocationsArray.slice();
            }

            var matchingLocationsTemp = [];

            for(var i = 0; i < matchingLocationsArray.length; i++){
                if((isStation === true && matchingLocationsArray[i].isStation === true) || (isTerminal === true && matchingLocationsArray[i].isTerminal === true)){
                    matchingLocationsTemp.push(matchingLocationsArray[i]);
                }
            }

            matchingLocationsArray = matchingLocationsTemp;

            if (matchingLocationsArray.length > 0) {
                matchingLocationsArray.sort(function (a, b) {
                    return parseFloat(a.distance) - parseFloat(b.distance);
                });

                currentSearchZoomLevel = radiusToZoom(parseFloat(matchingLocationsArray[0].distance));
            }else{
                currentSearchZoomLevel = 10;
            }

            _updateSearchListResults();
        }

        function updateSearchPlaceCookie(place) {
            if(matchingLocationsArray.length > 0) {
                var cookie = [cookieName, '=', JSON.stringify(place), '; domain=.', window.location.host.toString(), '; path=/;'].join('');
                document.cookie = cookie;
            }
        }

        function resetSearchPlaceCookie(){
            var cookie = [cookieName, '=', '', '; domain=.', window.location.host.toString(), '; path=/;'].join('');
            document.cookie = cookie;
        }

        function _checkForExistingCookie() {
          return false;
            var currentCookie = getSearchPlaceCookie();
            if (currentCookie !== null && typeof currentCookie === "object") {
                return true;
            } else {
                return false;
            }
        }

        function getSearchPlaceCookie() {
            var result = document.cookie.match(new RegExp(cookieName + '=([^;]+)'));
            result && (result = JSON.parse(result[1]));
            return result;
        }

        function getCurrentSearchZoomLevel() {
            return currentSearchZoomLevel;
        }

        function getProductName (name) {
            return (typeof productsMapping[name] !== "undefined")? productsMapping[name]: name;
        }

        function _getListOfMatchingLocations(lat, lng) {
            var matchingLocationsTemp = {};
            var distance = 0;

            if (typeof lat === "function") {
                lat = lat();
            }

            if (typeof lng === "function") {
                lng = lng();
            }

            $.each(markersRawArray, function (index, value) {
                distance = _isLocationInSearchRadius(lat, lng, markersRawArray[index].latitude, markersRawArray[index].longitude);
                if (distance <= mapSearchDistance) {
                    var index = parseInt(index);
                    matchingLocationsTemp[index] = markersRawArray[index];
                    matchingLocationsTemp[index].distance = distance.toFixed(2);
                    matchingLocationsTemp[index].visible = true;
                    matchingLocationsTemp[index].resultsId = index;
                }
            });


            matchingLocationsArray = $.map(matchingLocationsTemp, function(value, index) {
                return [value];
            });

            if (matchingLocationsArray.length > 0) {
                matchingLocationsArray.sort(function (a, b) {
                    return parseFloat(a.distance) - parseFloat(b.distance);
                });

                searchLocationsArray = matchingLocationsArray.slice();
                currentSearchZoomLevel = radiusToZoom(parseFloat(matchingLocationsArray[0].distance));
                hasSearchResults = true;
                matchingLocationsArray = [];

                var isStation = $filterCheckboxStation.is(':checked');
                var isTerminal = $filterCheckboxTerminal.is(':checked');

                for(var i = 0; i < searchLocationsArray.length; i++){
                    if((isStation === true && searchLocationsArray[i].isStation === true) || (isTerminal === true && searchLocationsArray[i].isTerminal === true)){
                        matchingLocationsArray.push(searchLocationsArray[i]);
                    }
                }

            }else{
                hasSearchResults = false;
                searchLocationsArray = [];
                currentSearchZoomLevel = 10;
            }

            _updateSearchListResults();
        }

        function _updateSearchListResults() {
            _updateSearchResultsLabel();
            _renderResultsInList();
        }

        function _updateStationsFilterDropdown() {
            if(matchingLocationsArray.length > 0) {
                for (var i = 0; i < matchingLocationsArray.length; i++) {
                    var itemId =  (typeof matchingLocationsArray[i].stationId !== "undefined")? matchingLocationsArray[i].stationId: null;
                    if(itemId !== null) {
                        $filterStationsDropdown.append(
                          $('<option></option>').val(itemId).html(itemId)
                        );
                    }
                }
                $filterStationsDropdown.chosen();
            }
        }

        function _updateSearchResultsLabel() {
            var string = "";
            var num = 0;

            if(matchingLocationsArray.length > 0) {
                for (var i = 0; i < matchingLocationsArray.length; i++) {
                    if(matchingLocationsArray[i].visible = true){
                        num++;
                    }
                }
            }

            switch (num) {
                case 0:
                {
                    string = "0 results found";
                    break;
                }
                case 1:
                {
                    string = "1 result found";
                    break;
                }
                default:
                {
                    string = num + " results found";
                    break;
                }
            }

            $resultsLabel.html(string);
        }

        function _renderResultsInList() {
            $resultsList.html("");

            for(var i = 0; i < markersArray.length; i++) {
                markersArray[i].setVisible(false);
            }
            markersCluster.clearMarkers();

            if(matchingLocationsArray.length > 0) {
                for (var i = 0; i < matchingLocationsArray.length; i++) {
                    if(matchingLocationsArray[i].visible = true){
                        var itemId =  (typeof matchingLocationsArray[i].stationId !== "undefined")? matchingLocationsArray[i].stationId: matchingLocationsArray[i].terminalId;
                        var $singleResultItem = _generateSingleResultItem(matchingLocationsArray[i], itemId);
                        $singleResultItem.appendTo($resultsList);
                        var locationMaker = markersArray.find(function(elem){
                            return elem.resultsId == itemId;
                        });
                        if(typeof locationMaker !== "undefined"){
                            locationMaker.setVisible(true);
                        }
                    }
                }

                markersCluster.addMarkers(markersArray);
            }

            if ($resultsList.children("li").length > 0) {
                $resultsList.show();
                $resultsStartSearch.hide();
            } else {
                $resultsList.hide();
                $resultsStartSearch.show();
            }

        }

        function _generateSingleResultItem(locationDetails, id) {
            var $item = $resultsElementTemplate.clone();
            var locationIcon = "distributor";
            var locationText = "";
            var address = "";
            var companyName = "";
            var isStation = (typeof locationDetails.stationId !== "undefined")? true: false;
            var distance = (typeof locationDetails.distance !== "undefined" && locationDetails.distance !== null)?" - "+locationDetails.distance+"miles":"";
            var itemId =  (typeof locationDetails.stationId !== "undefined")? locationDetails.stationId: locationDetails.terminalId;

            if(isStation === true) {
              locationText = "Station";
            }else{
              locationText = "Terminal";
            }

            if(typeof locationDetails.address !== "undefined"){
              address = locationDetails.address;
              address += '<br>' + locationDetails.city + ' ' + locationDetails.state + ' ' + locationDetails.zip;
            }

            if(typeof locationDetails.stationId !== "undefined"){
                companyName = locationDetails.stationId+"&nbsp;"+locationDetails.name+distance;
            }else{
                companyName = locationDetails.name+distance;
            }

            $item.attr("data-location-type", locationDetails.type);
            $item.attr("data-url", "#");
            $item.attr("data-distance", distance);
            $item.attr("data-location-id", id);
            $item.attr("data-results-id", itemId);
            $item.find(".result-company-name").html(companyName);
            $item.find(".result-address").html(address);
            $item.find(".result-icon").html("<img src='images/direction.png' class='directionImage'><span class='" + locationIcon + "'>" + locationText + "</span>>");


            return $item;
        }

        function _isLocationInSearchRadius(mapLad, mapLng, locationLat, locationLng) {
            var lat2 = parseFloat(locationLat);
            var lon2 = parseFloat(locationLng);
            var lat1 = mapLad;
            var lon1 = mapLng;
            var R = 6371;

            var x1 = lat2 - lat1;
            var dLat = x1.toRad();
            var x2 = lon2 - lon1;
            var dLon = x2.toRad();
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1.toRad()) * Math.cos(lat2.toRad()) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;

            return (d);
        }

        function _setElements() {
            $resultsListContainer = $(".search-map-container .results");
            $resultsList = $(".search-map-container .results ul");
            $resultsLabel = $(".search-map-container .search-result");
            $resultsStartSearch = $(".search-map-container .start-search");
            $resultsInput = $(".search-map-container #searchInput");
            $resultsReset = $(".search-map-container #resetSearch");
            $resultsElementTemplate = $(".search-map-container .search_list_element_template .list-element-template");
            $resultsInputGoButton = $(".search-map-container #searchInputGoButton");
            $mapLegendInstallers = $(".search-map-container .map-legend .legend-installer");
            $mapLegendDistributors = $(".search-map-container .map-legend .legend-distributors");
            $mapLegendRetailers = $(".search-map-container .map-legend .legend-retailers");
            $mapLegendRetailersTooltip = $("#legend-retailers-tooltip");
            $mapLegendDistributorsTooltip = $("#legend-distributors-tooltip");
            $mapLegendInstallersTooltip = $("#legend-installer-tooltip");
            $filterStationsDropdown = $(".search-map-container #stationsListFilter");
            // $infoWindowTerminalDropdown = $(".map-section .info-window-terminals-list");
            $filterCheckboxStation = $(".search-map-container #stationFilter");
            $filterCheckboxTerminal = $(".search-map-container #terminalFilter");
            $filterCheckboxAerial = $(".search-map-container #aerialFilter");
            $filterCheckboxPipeline = $(".search-map-container #pipelineFilter");
            $filterCheckboxStation.prop("checked", true);
            $filterCheckboxTerminal.prop("checked", true);
            $filterCheckboxAerial.prop("checked", true);
            $filterCheckboxPipeline.prop("checked", false);
        }

        function _setDefaults() {
            $resultsList.hide();
            $resultsStartSearch.show();
            $filterStationsDropdown.val("");
            //$resultsInput.val("Enter a address or postcode, eg Auckland");

            //$resultsList.show();
            //$resultsStartSearch.hide();
        }

        function radiusToZoom (radius){
            radius = radius*0.62;
            return Math.round(14-Math.log(radius)/Math.LN2);
        }

        function _setBinds() {
            $(".map-section").on("click", ".direction-to-terminal", function(e, targer){
                e.preventDefault();
                var stationDirection = $(this).data("direction");
                var terminalId = $(this).closest("p").find(".info-window-terminals-list").val();

                for(var i = 0; i < markersArray.length; i++) {
                    if (markersArray[i].resultsId == terminalId) {
                        var lat = markersArray[i].position.lat;
                        var lng = markersArray[i].position.lng;

                        if (typeof lat === "function") {
                            lat = lat();
                        }

                        if (typeof lng === "function") {
                            lng = lng();
                        }

                        stationDirection += "&origin=" + lat + "," + lng;
                    }
                }

                window.open(stationDirection);
            });
            $filterStationsDropdown.on("change", function(){
               var stationId = $(this).val();
               var foundMatch = false;
               if(stationId > 0){
                    for(var i = 0; i < markersArray.length; i++) {
                        if (markersArray[i].resultsId == stationId) {
                            _getListOfMatchingLocations(markersArray[i].position.lat, markersArray[i].position.lng);
                            mapObject.setZoom(14);
                            mapObject.panTo(markersArray[i].position);
                            google.maps.event.trigger(markersArray[i], 'click');
                            foundMatch = true;
                        }
                    }
                }

               if(foundMatch === false){
                   mapObject.setZoom(10);
                   parseSearchResults(null, null, true);
               }
            });
            $resultsList.on("click", ".list-element-template", function (e, target) {
                var elemClass = $(event.target).attr('class');
                switch(elemClass){
                    case "result-details":
                    case "result-address":
                    case "result-company-name":
                    case "list-element-template":
                    {
                        var $parent = $(this).closest(".list-element-template");
                        //var id = $parent.data("results-id");
                        var id = $parent.data("location-id");
                        var record = null;
                        for(var i = 0; i < markersArray.length; i++){
                              if(markersArray[i].resultsId == id){
                                  record = markersArray[i];
                              }
                          }

                        if(record !== null){
                            mapObject.setZoom(14);
                            mapObject.panTo(record.position);
                            google.maps.event.trigger(record, 'click');
                            //record['infowindow'].open(mapObject, mapObject);
                        }

                        $(".map-section-container").get(0).scrollIntoView();
                    break;}
                    case "directionImage":
                    case "distributor":
                    case "result-icon":{
                        var $parent = $(this).closest(".list-element-template");
                        var id = $parent.data("location-id");
                        var record = markersRawArray[id];
                        var url = "https://www.google.com/maps/dir/?api=1&destination="+record.latitude+","+record.longitude;
                        window.open(url, '_blank');
                    break;}
                    default:{
                        console.error(elemClass);
                    break;}
                }
            });

            $resultsInput.on("focus", function (e, target) {
                $resultsReset.show();
            });

            $resultsInput.on("blur", function (e, target) {
                if($resultsInput.val() == "") {
                    $resultsReset.hide();
                }
            });

            $resultsReset.on("click", function(){
                if(matchingLocationsArray.length > 0) {
                    for (var i = 0; i < matchingLocationsArray.length; i++) {
                        matchingLocationsArray[i].distance = null;
                    }
                }

                $resultsInput.val("");
                resetSearchPlaceCookie();
                parseSearchResults(null, null, true);
                mapObject.setZoom(10);
                currentSearchZoomLevel = 10;

                window.updateCurrentLocationOnMap.bind(window)();
            });

            $filterCheckboxStation.on("change", function(){
                filterMarkersByCheckbox();
            });

            $filterCheckboxTerminal.on("change", function(){
                filterMarkersByCheckbox();
            });

            $filterCheckboxAerial.on("change", function(){
                toggleAerialOverlay();
            });

            $filterCheckboxPipeline.on("change", function(){
                togglePipelineOverlay();
            });

        }

        return {
            init: init,
            loadDefaultData: loadDefaultData,
            updateSearchPlaceCookie: updateSearchPlaceCookie,
            getSearchPlaceCookie: getSearchPlaceCookie,
            setMapAutoComplete: setMapAutoComplete,
            setMapInfoWindow: setMapInfoWindow,
            setMarkers: setMarkers,
            setAerialData: setAerialData,
            setPipelineData: setPipelineData,
            setMapObject: setMapObject,
            setMarkersRawData: setMarkersRawData,
            setMarkersCluster: setMarkersCluster,
            parseSearchResults: parseSearchResults,
            getCurrentSearchZoomLevel: getCurrentSearchZoomLevel,
            getProductName: getProductName,
            isOffsetStation: isOffsetStation
        };
    }

    return {
        getInstance: function () {
            if (!jacoMapInstance) {
                jacoMapInstance = create();
            }
            return jacoMapInstance;
        }
    };
})();
