<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Test</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --nihsa-primary: #0056b3;
            --nihsa-secondary: #28a745;
            --nihsa-warning: #ffc107;
            --nihsa-danger: #dc3545;
        }

        #map {
            height: 500px;
            width: 100%;
            border: 2px solid #ccc;
            border-radius: 8px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .info {
            margin: 20px 0;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .stats-card {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .risk-high .stats-number { color: var(--nihsa-danger); }
        .risk-high::before { background: var(--nihsa-danger); }

        .risk-moderate .stats-number { color: var(--nihsa-warning); }
        .risk-moderate::before { background: var(--nihsa-warning); }

        .risk-low .stats-number { color: var(--nihsa-secondary); }
        .risk-low::before { background: var(--nihsa-secondary); }

        .risk-total .stats-number { color: var(--nihsa-primary); }
        .risk-total::before { background: var(--nihsa-primary); }

        .container {
            max-width: 1200px;
        }

        .map-container {
            position: relative;
        }

        .map-legend {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            min-width: 200px;
            border: 1px solid #dee2e6;
        }

        .map-legend h6 {
            margin-bottom: 12px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .legend-item:last-child {
            margin-bottom: 0;
        }

        .legend-color {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid #fff;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.2);
        }

        .legend-divider {
            border-top: 1px solid #dee2e6;
            margin: 10px 0;
        }
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #003366;
            color: #ffffff;
            padding: 1rem;
            text-align: center;
        }

        .content {
            padding: 1rem;
        }

        .dashboard-embed {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        iframe {
            width: 100%;
            height: 800px;
            border: 0;
        }

        @media (max-width: 768px) {
            iframe {
                height: 600px;
            }
        }

        @media (max-width: 480px) {
            iframe {
                height: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Back to Dashboard Button -->
        <div class="mb-4">
            <button onclick="window.history.back()" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>
                Back to Dashboard
            </button>
        </div>

        <div class="content">
        <div class="dashboard-embed">
            <iframe 
                src="https://www.arcgis.com/apps/dashboards/f2cf8b7080454740ab5ed0300b1de6a4"
                allowfullscreen
                frameborder="0">
            </iframe>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            try {
                
                // Create map
                const map = L.map('map').setView([9.0820, 8.6753], 6);
                
                // Add tile layer
                L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                    maxZoom: 19,
                    subdomains: 'abcd'
                }).addTo(map);
                
                // Add a test marker
                L.marker([9.0820, 8.6753]).addTo(map)
                    .bindPopup('Nigeria Center')
                    .openPopup();
                
                // Add test markers for flood data matching the legend
                const testMarkers = [
                    // High Risk Areas (7 areas - red)
                    {lat: 9.0765, lng: 7.3986, name: 'FCT Abuja', risk: 'High', type: 'Flash/Urban'},
                    {lat: 6.6018, lng: 3.5106, name: 'Lagos', risk: 'High', type: 'Coastal'},
                    {lat: 4.8156, lng: 7.0498, name: 'Port Harcourt', risk: 'High', type: 'Riverine'},
                    {lat: 11.8469, lng: 13.1571, name: 'Maiduguri', risk: 'High', type: 'Flash/Urban'},
                    {lat: 7.3775, lng: 3.9470, name: 'Ibadan', risk: 'High', type: 'Flash/Urban'},
                    {lat: 10.5105, lng: 7.4165, name: 'Kaduna', risk: 'High', type: 'Riverine'},
                    {lat: 6.2649, lng: 7.1783, name: 'Enugu', risk: 'High', type: 'Riverine'},

                    // Moderate Risk Areas (5 areas - orange)
                    {lat: 12.0022, lng: 8.5919, name: 'Kano', risk: 'Moderate', type: 'Flash/Urban'},
                    {lat: 5.0197, lng: 6.7359, name: 'Uyo', risk: 'Moderate', type: 'Coastal'},
                    {lat: 9.0579, lng: 7.4951, name: 'Nasarawa', risk: 'Moderate', type: 'Riverine'},
                    {lat: 6.5244, lng: 3.3792, name: 'Ikorodu', risk: 'Moderate', type: 'Coastal'},
                    {lat: 8.8932, lng: 11.7824, name: 'Yola', risk: 'Moderate', type: 'Riverine'},

                    // Low Risk Areas (1 area - yellow)
                    {lat: 13.0059, lng: 5.2476, name: 'Sokoto', risk: 'Low', type: 'Flash/Urban'}
                ];

                testMarkers.forEach(function(marker) {
                    let color, borderColor;

                    // Set color based on risk level
                    switch(marker.risk) {
                        case 'High':
                            color = '#ff0000';
                            borderColor = '#cc0000';
                            break;
                        case 'Moderate':
                            color = '#ffa500';
                            borderColor = '#cc8400';
                            break;
                        case 'Low':
                            color = '#ffff00';
                            borderColor = '#cccc00';
                            break;
                    }

                    // Override color based on flood type
                    if (marker.type === 'Coastal') {
                        color = '#00cc66';
                        borderColor = '#009944';
                    } else if (marker.type === 'Flash/Urban') {
                        color = '#9900cc';
                        borderColor = '#770099';
                    } else if (marker.type === 'Riverine') {
                        color = '#0066cc';
                        borderColor = '#004499';
                    }

                    L.circleMarker([marker.lat, marker.lng], {
                        radius: 8,
                        fillColor: color,
                        color: borderColor,
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.8
                    }).addTo(map)
                    .bindPopup(`
                        <div>
                            <h6><strong>${marker.name}</strong></h6>
                            <p><strong>Risk Level:</strong> <span style="color: ${marker.risk === 'High' ? '#dc3545' : (marker.risk === 'Moderate' ? '#ffc107' : '#28a745')}">${marker.risk}</span></p>
                            <p><strong>Flood Type:</strong> ${marker.type}</p>
                        </div>
                    `);
                });

            } catch (error) {
                console.error('Map error:', error);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
