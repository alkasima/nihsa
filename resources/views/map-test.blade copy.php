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
    </style>
</head>
<body>
    <div class="container py-4">
        <h1 class="text-center mb-4">Map Test Page with Flood Risk Cards</h1>

        <div class="info">
            <p>This is a simple test to check if Leaflet maps are working with flood risk statistics.</p>
            <p id="status">Loading...</p>
        </div>

        <!-- Flood Risk Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="stats-card risk-total">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stats-number">156</div>
                            <div class="stats-label">Total Communities</div>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-home fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card risk-high">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stats-number">42</div>
                            <div class="stats-label">High Risk Areas</div>
                        </div>
                        <div class="text-danger">
                            <i class="fas fa-exclamation-triangle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card risk-moderate">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stats-number">78</div>
                            <div class="stats-label">Moderate Risk Areas</div>
                        </div>
                        <div class="text-warning">
                            <i class="fas fa-exclamation-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card risk-low">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stats-number">36</div>
                            <div class="stats-label">Low Risk Areas</div>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-check-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="map"></div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusEl = document.getElementById('status');
            
            try {
                statusEl.textContent = 'Leaflet version: ' + L.version;
                
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
                
                // Add some test markers for flood data
                const testMarkers = [
                    {lat: 9.0765, lng: 7.3986, name: 'FCT Abuja', risk: 'High'},
                    {lat: 6.6018, lng: 3.5106, name: 'Lagos', risk: 'High'},
                    {lat: 4.8156, lng: 7.0498, name: 'Port Harcourt', risk: 'High'}
                ];
                
                testMarkers.forEach(function(marker) {
                    const color = marker.risk === 'High' ? 'red' : 'orange';
                    L.circleMarker([marker.lat, marker.lng], {
                        radius: 8,
                        fillColor: color,
                        color: '#000',
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.8
                    }).addTo(map)
                    .bindPopup(`<b>${marker.name}</b><br>Risk: ${marker.risk}`);
                });
                
                statusEl.textContent = 'Map loaded successfully! Leaflet version: ' + L.version;
                statusEl.style.color = 'green';
                
            } catch (error) {
                statusEl.textContent = 'Error: ' + error.message;
                statusEl.style.color = 'red';
                console.error('Map error:', error);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
