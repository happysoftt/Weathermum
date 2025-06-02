<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พยากรณ์อากาศไทย Professional - Thai Weather Forecast</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        /* Simple Professional Color Scheme */
        
         :root {
            --primary-blue: #2563eb;
            --light-blue: #3b82f6;
            --sky-blue: #0ea5e9;
            --text-primary: #1f2937;
            --text-secondary: #4b5563;
            --text-muted: #6b7280;
            --card-bg: rgba(255, 255, 255, 0.95);
            --card-border: rgba(37, 99, 235, 0.2);
            --shadow: rgba(37, 99, 235, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.9);
            --glass-border: rgba(37, 99, 235, 0.3);
        }
        /* Simple Clean Background */
        
        body {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 25%, #93c5fd 50%, #60a5fa 75%, #3b82f6 100%);
            min-height: 100vh;
            color: var(--text-primary);
            position: relative;
            overflow-x: hidden;
        }
        /* Glass Morphism Effects */
        
        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            box-shadow: 0 8px 32px var(--shadow);
            color: var(--text-primary);
            position: relative;
            z-index: 10;
        }
        
        .glass-header {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-bottom: 1px solid rgba(37, 99, 235, 0.2);
        }
        
        .glass-mini {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            box-shadow: 0 4px 20px var(--shadow);
        }
        /* Enhanced Weather Card */
        
        .weather-main-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 12px 40px var(--shadow);
            color: var(--text-primary);
            position: relative;
            overflow: hidden;
        }
        
        .weather-main-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2563eb, #3b82f6, #0ea5e9, #60a5fa);
            border-radius: 24px 24px 0 0;
        }
        /* Professional Buttons */
        
        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.6);
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-blue);
            border: 1px solid var(--card-border);
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .btn-secondary:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }
        /* Enhanced Input Styles */
        
        .input-field {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid var(--card-border);
            color: var(--text-primary);
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .input-field:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            transform: translateY(-1px);
        }
        
        .input-field::placeholder {
            color: var(--text-muted);
        }
        /* Enhanced Weather Cards */
        
        .weather-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 8px 32px var(--shadow);
            color: var(--text-primary);
            transition: all 0.3s ease;
            backdrop-filter: blur(20px);
        }
        
        .weather-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(37, 99, 235, 0.2);
        }
        /* Weather Detail Cards */
        
        .weather-detail-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.8) 100%);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(15px);
            position: relative;
            overflow: hidden;
        }
        
        .weather-detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 16px 16px 0 0;
        }
        
        .weather-detail-card.humidity::before {
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        }
        
        .weather-detail-card.wind::before {
            background: linear-gradient(90deg, #10b981, #059669);
        }
        
        .weather-detail-card.visibility::before {
            background: linear-gradient(90deg, #8b5cf6, #7c3aed);
        }
        
        .weather-detail-card.pressure::before {
            background: linear-gradient(90deg, #f59e0b, #d97706);
        }
        
        .weather-detail-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
        }
        /* Professional Text Colors */
        
        .text-primary {
            color: var(--text-primary);
        }
        
        .text-secondary {
            color: var(--text-secondary);
        }
        
        .text-muted {
            color: var(--text-muted);
        }
        
        .text-white {
            color: #ffffff;
        }
        
        .text-blue {
            color: var(--primary-blue);
        }
        
        .text-green {
            color: #059669;
        }
        
        .text-orange {
            color: #d97706;
        }
        
        .text-red {
            color: #dc2626;
        }
        
        .text-purple {
            color: #7c3aed;
        }
        /* Enhanced Dropdown */
        
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background: rgba(255, 255, 255, 0.95);
            min-width: 220px;
            box-shadow: 0 12px 40px rgba(37, 99, 235, 0.15);
            border-radius: 12px;
            border: 1px solid var(--card-border);
            z-index: 1000;
            max-height: 320px;
            overflow-y: auto;
            backdrop-filter: blur(20px);
        }
        
        .dropdown-content.show {
            display: block;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-item {
            color: var(--text-primary);
            padding: 14px 18px;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            cursor: pointer;
            border-bottom: 1px solid rgba(37, 99, 235, 0.1);
        }
        
        .dropdown-item:hover {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: white;
            transform: translateX(4px);
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        /* Enhanced Loading */
        
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(37, 99, 235, 0.2);
            border-top: 4px solid var(--primary-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        /* Enhanced Chart Container */
        
        .chart-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--card-border);
            backdrop-filter: blur(15px);
        }
        /* Enhanced Tabs */
        
        .tab-button {
            background: rgba(255, 255, 255, 0.8);
            color: var(--text-secondary);
            border: 1px solid var(--card-border);
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            backdrop-filter: blur(10px);
        }
        
        .tab-button:hover {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-blue);
            transform: translateY(-1px);
        }
        
        .tab-button.active {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: white;
            border-color: var(--primary-blue);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }
        /* Enhanced Notification */
        
        .notification {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            max-width: 400px;
            padding: 16px 20px;
            border-radius: 12px;
            color: white;
            font-weight: 500;
            transform: translateX(100%);
            transition: transform 0.4s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .notification.error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        
        .notification.info {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        /* Enhanced Search Results */
        
        .search-results {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            border: 1px solid var(--card-border);
            backdrop-filter: blur(20px);
            box-shadow: 0 12px 40px rgba(37, 99, 235, 0.15);
        }
        
        .search-item {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(37, 99, 235, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .search-item:hover {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
            transform: translateX(4px);
        }
        
        .search-item:last-child {
            border-bottom: none;
        }
        /* Location Type Tags */
        
        .location-tag {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .tag-province {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }
        
        .tag-district {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .tag-subdistrict {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }
        
        .tag-postal {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }
        
        .tag-global {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
        /* Responsive Enhancements */
        
        @media (max-width: 768px) {
            .glass-card {
                margin: 0 12px;
                border-radius: 16px;
            }
            .weather-main-card {
                border-radius: 20px;
            }
            .notification {
                right: 16px;
                left: 16px;
                max-width: none;
            }
            .dropdown-content {
                min-width: 200px;
            }
        }
        /* Enhanced Scrollbar */
        
         ::-webkit-scrollbar {
            width: 8px;
        }
        
         ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        
         ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border-radius: 4px;
        }
        
         ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }
        /* Weather Icon Animation */
        
        .weather-icon {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%,
            100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        /* Enhanced Weather Details Grid */
        
        .weather-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 16px;
        }
        
        @media (max-width: 640px) {
            .weather-details-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        /* Additional Weather Info Cards */
        
        .additional-info-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.8) 100%);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 20px;
            backdrop-filter: blur(15px);
            transition: all 0.3s ease;
        }
        
        .additional-info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.1);
        }
    </style>
</head>

<body>
    <!-- Professional Notification Container -->
    <div id="notificationContainer"></div>

    <!-- Professional Header -->
    <header class="glass-header p-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl md:text-3xl font-bold text-primary flex items-center">
                <i class="fas fa-cloud-sun mr-3 text-blue-500"></i>
                <span>พยากรณ์อากาศไทย</span>
                <span class="ml-2 text-sm text-blue-600 font-normal">Professional</span>
            </h1>

            <!-- Professional Controls -->
            <div class="flex items-center space-x-3">
                <button id="alertsToggle" class="btn-secondary">
                    <i class="fas fa-bell"></i>
                    <span id="alertBadge" class="hidden ml-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">!</span>
                </button>

                <button id="favoritesToggle" class="btn-secondary">
                    <i class="fas fa-heart"></i>
                </button>

                <select id="languageSelect" class="input-field text-sm">
                    <option value="th">🇹🇭 ไทย</option>
                    <option value="en">🇺🇸 English</option>
                </select>

                <button id="settingsToggle" class="btn-secondary">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-6">
        <!-- Enhanced Search Section -->
        <div class="glass-card p-6 md:p-8 mb-6 md:mb-8">
            <div class="flex flex-col lg:flex-row gap-4 md:gap-6">
                <!-- Enhanced Location Search -->
                <div class="flex-1 relative">
                    <div class="relative">
                        <input type="text" id="locationSearch" placeholder="🔍 ค้นหาทุกที่ในโลก: จังหวัด อำเภอ ตำบล รหัสไปรษณีย์ หรือชื่อเมือง..." class="w-full input-field pl-12 pr-12">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <div id="searchLoading" class="absolute right-4 top-1/2 transform -translate-y-1/2 hidden">
                            <div class="loading-spinner w-5 h-5"></div>
                        </div>
                        <button id="voiceSearch" class="absolute right-12 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-all">
                            <i class="fas fa-microphone"></i>
                        </button>
                    </div>

                    <!-- Enhanced Search Dropdown -->
                    <div id="searchDropdown" class="absolute top-full left-0 right-0 search-results mt-2 hidden z-50">
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center gap-2 text-sm text-gray-600 flex-wrap">
                                <span class="location-tag tag-province">จังหวัด</span>
                                <span class="location-tag tag-district">อำเภอ</span>
                                <span class="location-tag tag-subdistrict">ตำบล</span>
                                <span class="location-tag tag-postal">รหัสไปรษณีย์</span>
                                <span class="location-tag tag-global">ทั่วโลก</span>
                            </div>
                        </div>
                        <div id="searchResults" class="max-h-80 overflow-y-auto">
                        </div>
                    </div>
                </div>

                <!-- Enhanced Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                    <button id="currentLocationBtn" class="btn-primary flex items-center justify-center min-w-[180px] md:min-w-[200px]">
                        <i class="fas fa-location-arrow mr-2"></i>
                        ตำแหน่งปัจจุบัน
                    </button>

                    <!-- Enhanced Forecast Dropdown -->
                    <div class="dropdown">
                        <button id="forecastDropdown" class="btn-secondary flex items-center justify-center min-w-[180px] md:min-w-[200px]">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span id="selectedForecast">วันนี้</span>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div id="forecastOptions" class="dropdown-content">
                            <div class="dropdown-item" data-days="0">
                                <i class="fas fa-sun mr-2 text-orange-500"></i> วันนี้
                            </div>
                            <div class="dropdown-item" data-days="1">
                                <i class="fas fa-calendar-day mr-2 text-blue-500"></i> พรุ่งนี้
                            </div>
                            <div class="dropdown-item" data-days="2">
                                <i class="fas fa-calendar mr-2 text-green-500"></i> 2 วันข้างหน้า
                            </div>
                            <div class="dropdown-item" data-days="3">
                                <i class="fas fa-calendar mr-2 text-purple-500"></i> 3 วันข้างหน้า
                            </div>
                            <div class="dropdown-item" data-days="4">
                                <i class="fas fa-calendar mr-2 text-red-500"></i> 4 วันข้างหน้า
                            </div>
                            <div class="dropdown-item" data-days="5">
                                <i class="fas fa-calendar mr-2 text-indigo-500"></i> 5 วันข้างหน้า
                            </div>
                            <div class="dropdown-item" data-days="6">
                                <i class="fas fa-calendar mr-2 text-pink-500"></i> 6 วันข้างหน้า
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Quick Access & Favorites -->
            <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Quick Locations -->
                <div>
                    <div class="text-gray-700 text-sm mb-3 font-semibold flex items-center">
                        <i class="fas fa-star mr-2 text-yellow-500"></i> สถานที่ยอดนิยม:
                    </div>
                    <div class="flex flex-wrap gap-2" id="quickLocations">
                        <button class="btn-secondary text-sm" data-lat="13.7563" data-lon="100.5018" data-name="กรุงเทพมหานคร">
                            🏙️ กรุงเทพฯ
                        </button>
                        <button class="btn-secondary text-sm" data-lat="18.7883" data-lon="98.9853" data-name="เชียงใหม่">
                            🏔️ เชียงใหม่
                        </button>
                        <button class="btn-secondary text-sm" data-lat="7.8804" data-lon="98.3923" data-name="ภูเก็ต">
                            🏖️ ภูเก็ต
                        </button>
                        <button class="btn-secondary text-sm" data-lat="12.9236" data-lon="100.8825" data-name="พัทยา">
                            🌊 พัทยา
                        </button>
                        <button class="btn-secondary text-sm" data-lat="7.0061" data-lon="100.4951" data-name="หาดใหญ่">
                            🌴 หาดใหญ่
                        </button>
                    </div>
                </div>

                <!-- Favorites -->
                <div id="favoritesSection" class="hidden">
                    <div class="text-gray-700 text-sm mb-3 font-semibold flex items-center">
                        <i class="fas fa-heart mr-2 text-red-500"></i> สถานที่โปรด:
                    </div>
                    <div class="flex flex-wrap gap-2" id="favoritesList">
                        <!-- Favorites will be populated here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Weather Alerts -->
        <div id="weatherAlerts" class="hidden mb-6">
            <div class="weather-card border-l-4 border-orange-500 bg-gradient-to-r from-orange-50 to-red-50">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-orange-500 text-2xl mr-4"></i>
                    <div>
                        <h3 class="text-orange-800 font-bold text-lg">⚠️ แจ้งเตือนสภาพอากาศ</h3>
                        <p class="text-orange-700" id="alertMessage">มีฝนฟ้าคะนองในพื้นที่ โปรดระวังและหลีกเลี่ยงการเดินทางที่ไม่จำเป็น</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Loading Indicator -->
        <div id="loadingIndicator" class="hidden flex flex-col justify-center items-center py-12">
            <div class="loading-spinner mb-4"></div>
            <span class="text-primary text-lg font-medium">กำลังโหลดข้อมูลสภาพอากาศ...</span>
            <div class="mt-2 text-secondary text-sm">โปรดรอสักครู่</div>
        </div>

        <!-- Enhanced Current Weather -->
        <div id="currentWeather" class="weather-main-card mb-6 md:mb-8 hidden">
            <div class="p-6 md:p-8">
                <!-- Location and Time Header -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h2 id="locationName" class="text-2xl md:text-3xl font-bold text-primary mb-2 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i> กรุงเทพมหานคร
                        </h2>
                        <p id="currentTime" class="text-secondary text-base md:text-lg flex items-center">
                            <i class="fas fa-clock mr-2 text-blue-500"></i> วันจันทร์ที่ 2 มิถุนายน 2568 เวลา 13:36
                        </p>
                    </div>
                    <button id="addToFavorites" class="btn-primary mt-4 md:mt-0">
                        <i class="fas fa-heart mr-2"></i>
                        เพิ่มในรายการโปรด
                    </button>
                </div>

                <!-- Main Weather Display -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Weather Icon and Temperature -->
                    <div class="flex items-center justify-center lg:justify-start">
                        <div class="text-center lg:text-left">
                            <div id="weatherIcon" class="text-8xl md:text-9xl mb-4 weather-icon">☁️</div>
                            <div id="currentTemp" class="text-6xl md:text-7xl font-bold text-primary mb-2">33°C</div>
                            <div id="weatherDescription" class="text-secondary text-xl md:text-2xl font-medium mb-2">มีเมฆมาก</div>
                            <div id="feelsLike" class="text-muted text-lg">รู้สึกเหมือน 36°C</div>
                        </div>
                    </div>

                    <!-- Weather Details Grid -->
                    <div class="weather-details-grid">
                        <div class="weather-detail-card humidity">
                            <i class="fas fa-tint text-blue-500 text-2xl mb-3"></i>
                            <div class="text-blue-700 text-sm font-medium mb-1">ความชื้น</div>
                            <div id="humidity" class="text-blue-900 font-bold text-2xl">60%</div>
                            <div class="text-blue-600 text-xs mt-1">ปกติ</div>
                        </div>

                        <div class="weather-detail-card wind">
                            <i class="fas fa-wind text-green-500 text-2xl mb-3"></i>
                            <div class="text-green-700 text-sm font-medium mb-1">ความเร็วลม</div>
                            <div id="windSpeed" class="text-green-900 font-bold text-2xl">8 km/h</div>
                            <div class="text-green-600 text-xs mt-1">ลมเบา</div>
                        </div>

                        <div class="weather-detail-card visibility">
                            <i class="fas fa-eye text-purple-500 text-2xl mb-3"></i>
                            <div class="text-purple-700 text-sm font-medium mb-1">ทัศนวิสัย</div>
                            <div id="visibility" class="text-purple-900 font-bold text-2xl">10 km</div>
                            <div class="text-purple-600 text-xs mt-1">ดีเยี่ยม</div>
                        </div>

                        <div class="weather-detail-card pressure">
                            <i class="fas fa-thermometer-half text-orange-500 text-2xl mb-3"></i>
                            <div class="text-orange-700 text-sm font-medium mb-1">ความกดอากาศ</div>
                            <div id="pressure" class="text-orange-900 font-bold text-2xl">1007 hPa</div>
                            <div class="text-orange-600 text-xs mt-1">ปกติ</div>
                        </div>

                        <div class="weather-detail-card">
                            <i class="fas fa-sun text-yellow-500 text-2xl mb-3"></i>
                            <div class="text-yellow-700 text-sm font-medium mb-1">ดัชนี UV</div>
                            <div id="uvIndex" class="text-yellow-900 font-bold text-2xl">7</div>
                            <div class="text-yellow-600 text-xs mt-1">สูง</div>
                        </div>

                        <div class="weather-detail-card">
                            <i class="fas fa-thermometer-quarter text-indigo-500 text-2xl mb-3"></i>
                            <div class="text-indigo-700 text-sm font-medium mb-1">จุดน้ำค้าง</div>
                            <div id="dewPoint" class="text-indigo-900 font-bold text-2xl">24°C</div>
                            <div class="text-indigo-600 text-xs mt-1">ปกติ</div>
                        </div>
                    </div>
                </div>

                <!-- Additional Weather Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="additional-info-card text-center">
                        <i class="fas fa-sunrise text-orange-400 text-3xl mb-3"></i>
                        <div class="text-gray-700 text-sm font-medium mb-1">พระอาทิตย์ขึ้น</div>
                        <div id="sunrise" class="text-gray-900 font-bold text-xl">06:15</div>
                    </div>

                    <div class="additional-info-card text-center">
                        <i class="fas fa-sunset text-orange-600 text-3xl mb-3"></i>
                        <div class="text-gray-700 text-sm font-medium mb-1">พระอาทิตย์ตก</div>
                        <div id="sunset" class="text-gray-900 font-bold text-xl">18:45</div>
                    </div>

                    <div class="additional-info-card text-center">
                        <i class="fas fa-clock text-purple-500 text-3xl mb-3"></i>
                        <div class="text-gray-700 text-sm font-medium mb-1">ระยะเวลาแสง</div>
                        <div id="dayLength" class="text-gray-900 font-bold text-xl">12 ชม. 30 นาที</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Weather Highlights -->
        <div id="weatherHighlights" class="weather-card mb-6 md:mb-8 hidden">
            <h3 class="text-xl md:text-2xl font-bold text-primary mb-6 flex items-center">
                <i class="fas fa-star mr-3 text-yellow-500"></i> ไฮไลท์สภาพอากาศวันนี้
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6" id="highlightsGrid">
            </div>
        </div>

        <!-- Enhanced Hourly Forecast -->
        <div id="hourlyForecast" class="weather-card mb-6 md:mb-8 hidden">
            <h3 class="text-xl md:text-2xl font-bold text-primary mb-6 flex items-center">
                <i class="fas fa-chart-line mr-3 text-blue-500"></i> พยากรณ์รายชั่วโมง
            </h3>

            <!-- Enhanced Chart Tabs -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button class="tab-button active" data-chart="temperature">
                    🌡️ อุณหภูมิ
                </button>
                <button class="tab-button" data-chart="humidity">
                    💧 ความชื้น
                </button>
                <button class="tab-button" data-chart="wind">
                    💨 ลม
                </button>
                <button class="tab-button" data-chart="pressure">
                    📊 ความกดอากาศ
                </button>
            </div>

            <div class="chart-container">
                <canvas id="weatherChart" width="400" height="200"></canvas>
            </div>

            <!-- Enhanced Hourly Cards -->
            <div class="mt-8 overflow-x-auto">
                <div class="flex gap-4 min-w-max pb-4" id="hourlyCards">
                    <!-- Hourly cards will be populated here -->
                </div>
            </div>
        </div>

        <!-- Enhanced 7-Day Forecast -->
        <div id="weeklyForecast" class="weather-card mb-6 md:mb-8 hidden">
            <h3 class="text-xl md:text-2xl font-bold text-primary mb-6 flex items-center">
                <i class="fas fa-calendar-week mr-3 text-green-500"></i> พยากรณ์อากาศล่วงหน้า
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4" id="weeklyGrid">
                <!-- Weekly forecast will be populated here -->
            </div>
        </div>

        <!-- Enhanced Additional Information -->
        <div id="additionalInfo" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 hidden">
            <!-- Air Quality -->
            <div class="weather-card">
                <h4 class="text-lg md:text-xl font-bold text-primary mb-6 flex items-center">
                    <i class="fas fa-lungs mr-3 text-green-500"></i> คุณภาพอากาศ
                </h4>
                <div id="airQuality" class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-green-600 mb-4">ดี</div>
                    <div class="text-gray-700 text-base md:text-lg mb-4">PM2.5: 25 μg/m³</div>
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                        <div class="bg-green-500 h-3 rounded-full transition-all duration-1000" style="width: 30%"></div>
                    </div>
                    <div class="text-gray-600 text-sm">ปลอดภัยสำหรับกิจกรรมกลางแจ้ง</div>
                </div>
            </div>

            <!-- UV Index -->
            <div class="weather-card">
                <h4 class="text-lg md:text-xl font-bold text-primary mb-6 flex items-center">
                    <i class="fas fa-sun mr-3 text-yellow-500"></i> ดัชนี UV
                </h4>
                <div id="uvIndexCard" class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-orange-600 mb-4">7</div>
                    <div class="text-gray-700 text-base md:text-lg mb-4">สูง - ควรป้องกัน</div>
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                        <div class="bg-orange-500 h-3 rounded-full transition-all duration-1000" style="width: 70%"></div>
                    </div>
                    <div class="text-gray-600 text-sm">ใช้ครีมกันแดด SPF 30+</div>
                </div>
            </div>

            <!-- Weather Map -->
            <div class="weather-card">
                <h4 class="text-lg md:text-xl font-bold text-primary mb-6 flex items-center">
                    <i class="fas fa-map mr-3 text-purple-500"></i> แผนที่สภาพอากาศ
                </h4>
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl p-6 h-48 flex items-center justify-center border border-purple-200">
                    <div class="text-center text-gray-600">
                        <i class="fas fa-map-marked-alt text-4xl mb-4 text-purple-400"></i>
                        <p class="font-medium">แผนที่สภาพอากาศ</p>
                        <p class="text-sm mt-2">รองรับในเวอร์ชันถัดไป</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Settings Modal -->
    <div id="settingsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="glass-card p-6 md:p-8 max-w-md w-full">
            <h3 class="text-xl md:text-2xl font-bold text-primary mb-6 flex items-center">
                <i class="fas fa-cog mr-3 text-blue-500"></i> การตั้งค่า
            </h3>

            <div class="space-y-6">
                <!-- Temperature Unit -->
                <div>
                    <label class="text-gray-700 font-medium mb-2 block">หน่วยอุณหภูมิ</label>
                    <select id="tempUnit" class="w-full input-field">
                        <option value="celsius">เซลเซียส (°C)</option>
                        <option value="fahrenheit">ฟาเรนไฮต์ (°F)</option>
                    </select>
                </div>

                <!-- Wind Speed Unit -->
                <div>
                    <label class="text-gray-700 font-medium mb-2 block">หน่วยความเร็วลม</label>
                    <select id="windUnit" class="w-full input-field">
                        <option value="kmh">กิโลเมตร/ชั่วโมง</option>
                        <option value="ms">เมตร/วินาที</option>
                        <option value="mph">ไมล์/ชั่วโมง</option>
                    </select>
                </div>

                <!-- Notifications -->
                <div>
                    <label class="text-gray-700 font-medium mb-2 block">การแจ้งเตือน</label>
                    <div class="space-y-2">
                        <label class="flex items-center text-gray-700">
                            <input type="checkbox" id="rainAlerts" class="mr-3 rounded">
                            แจ้งเตือนฝน
                        </label>
                        <label class="flex items-center text-gray-700">
                            <input type="checkbox" id="tempAlerts" class="mr-3 rounded">
                            แจ้งเตือนอุณหภูมิสูง/ต่ำ
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mt-8">
                <button id="saveSettings" class="btn-primary flex-1">บันทึก</button>
                <button id="closeSettings" class="btn-secondary flex-1">ยกเลิก</button>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let currentLat = 13.7563;
        let currentLon = 100.5018;
        let currentLanguage = 'th';
        let weatherChart = null;
        let searchTimeout = null;
        let currentWeatherData = null;
        let selectedForecastDays = 0;
        let favorites = JSON.parse(localStorage.getItem('weatherFavorites')) || [];
        let settings = JSON.parse(localStorage.getItem('weatherSettings')) || {
            tempUnit: 'celsius',
            windUnit: 'kmh',
            rainAlerts: true,
            tempAlerts: true
        };

        // Comprehensive Thai locations database with postal codes
        const thaiLocationsExtended = [
            // กรุงเทพมหานคร
            {
                name: 'กรุงเทพมหานคร',
                type: 'province',
                lat: 13.7563,
                lon: 100.5018,
                postal: '10000'
            }, {
                name: 'บางนา',
                type: 'district',
                province: 'กรุงเทพมหานคร',
                lat: 13.6670,
                lon: 100.6000,
                postal: '10260'
            }, {
                name: 'ลาดกระบัง',
                type: 'district',
                province: 'กรุงเทพมหานคร',
                lat: 13.7307,
                lon: 100.7756,
                postal: '10520'
            }, {
                name: 'สาทร',
                type: 'district',
                province: 'กรุงเทพมหานคร',
                lat: 13.7200,
                lon: 100.5300,
                postal: '10120'
            }, {
                name: 'สุขุมวิท',
                type: 'district',
                province: 'กรุงเทพมหานคร',
                lat: 13.7400,
                lon: 100.5600,
                postal: '10110'
            }, {
                name: 'ราชเทวี',
                type: 'district',
                province: 'กรุงเทพมหานคร',
                lat: 13.7539,
                lon: 100.5418,
                postal: '10400'
            }, {
                name: 'ห้วยขวาง',
                type: 'district',
                province: 'กรุงเทพมหานคร',
                lat: 13.7658,
                lon: 100.5698,
                postal: '10310'
            }, {
                name: 'วัฒนา',
                type: 'district',
                province: 'กรุงเทพมหานคร',
                lat: 13.7308,
                lon: 100.5418,
                postal: '10110'
            }, {
                name: 'คลองเตย',
                type: 'district',
                province: 'กรุงเทพมหานคร',
                lat: 13.7200,
                lon: 100.5600,
                postal: '10110'
            }, {
                name: 'บางรัก',
                type: 'district',
                province: 'กรุงเทพมหานคร',
                lat: 13.7250,
                lon: 100.5150,
                postal: '10500'
            },

            // เชียงใหม่
            {
                name: 'เชียงใหม่',
                type: 'province',
                lat: 18.7883,
                lon: 98.9853,
                postal: '50000'
            }, {
                name: 'เมืองเชียงใหม่',
                type: 'district',
                province: 'เชียงใหม่',
                lat: 18.7883,
                lon: 98.9853,
                postal: '50000'
            }, {
                name: 'ดอยสะเก็ด',
                type: 'district',
                province: 'เชียงใหม่',
                lat: 18.9200,
                lon: 99.1300,
                postal: '50220'
            }, {
                name: 'แม่ริม',
                type: 'district',
                province: 'เชียงใหม่',
                lat: 18.8800,
                lon: 98.9200,
                postal: '50180'
            }, {
                name: 'สันกำแพง',
                type: 'district',
                province: 'เชียงใหม่',
                lat: 18.7500,
                lon: 99.1200,
                postal: '50130'
            }, {
                name: 'หางดง',
                type: 'district',
                province: 'เชียงใหม่',
                lat: 18.6700,
                lon: 98.9000,
                postal: '50230'
            },

            // ภูเก็ต
            {
                name: 'ภูเก็ต',
                type: 'province',
                lat: 7.8804,
                lon: 98.3923,
                postal: '83000'
            }, {
                name: 'เมืองภูเก็ต',
                type: 'district',
                province: 'ภูเก็ต',
                lat: 7.8804,
                lon: 98.3923,
                postal: '83000'
            }, {
                name: 'กะทู้',
                type: 'district',
                province: 'ภูเก็ต',
                lat: 7.9200,
                lon: 98.3400,
                postal: '83120'
            }, {
                name: 'ถลาง',
                type: 'district',
                province: 'ภูเก็ต',
                lat: 8.0300,
                lon: 98.3800,
                postal: '83110'
            }, {
                name: 'ป่าตอง',
                type: 'subdistrict',
                province: 'ภูเก็ต',
                lat: 7.8956,
                lon: 98.2964,
                postal: '83150'
            }, {
                name: 'กะรน',
                type: 'subdistrict',
                province: 'ภูเก็ต',
                lat: 7.8167,
                lon: 98.3000,
                postal: '83100'
            }, {
                name: 'กะตะ',
                type: 'subdistrict',
                province: 'ภูเก็ต',
                lat: 7.8167,
                lon: 98.3000,
                postal: '83100'
            },

            // สงขลา
            {
                name: 'สงขลา',
                type: 'province',
                lat: 7.0061,
                lon: 100.4951,
                postal: '90000'
            }, {
                name: 'หาดใหญ่',
                type: 'district',
                province: 'สงขลา',
                lat: 7.0061,
                lon: 100.4951,
                postal: '90110'
            }, {
                name: 'เมืองสงขลา',
                type: 'district',
                province: 'สงขลา',
                lat: 7.2000,
                lon: 100.6000,
                postal: '90000'
            }, {
                name: 'สะเดา',
                type: 'district',
                province: 'สงขลา',
                lat: 6.8500,
                lon: 100.4200,
                postal: '90240'
            },

            // ชลบุรี
            {
                name: 'ชลบุรี',
                type: 'province',
                lat: 13.3611,
                lon: 100.9847,
                postal: '20000'
            }, {
                name: 'พัทยา',
                type: 'district',
                province: 'ชลบุรี',
                lat: 12.9236,
                lon: 100.8825,
                postal: '20150'
            }, {
                name: 'บางละมุง',
                type: 'district',
                province: 'ชลบุรี',
                lat: 12.9000,
                lon: 100.9000,
                postal: '20150'
            }, {
                name: 'ศรีราชา',
                type: 'district',
                province: 'ชลบุรี',
                lat: 13.1700,
                lon: 100.9300,
                postal: '20110'
            }, {
                name: 'เมืองชลบุรี',
                type: 'district',
                province: 'ชลบุรี',
                lat: 13.3611,
                lon: 100.9847,
                postal: '20000'
            },

            // เชียงราย
            {
                name: 'เชียงราย',
                type: 'province',
                lat: 19.9105,
                lon: 99.8406,
                postal: '57000'
            }, {
                name: 'เมืองเชียงราย',
                type: 'district',
                province: 'เชียงราย',
                lat: 19.9105,
                lon: 99.8406,
                postal: '57000'
            }, {
                name: 'แม่สาย',
                type: 'district',
                province: 'เชียงราย',
                lat: 20.4300,
                lon: 99.8800,
                postal: '57130'
            }, {
                name: 'เชียงของ',
                type: 'district',
                province: 'เชียงราย',
                lat: 19.9800,
                lon: 100.0800,
                postal: '57140'
            },

            // ขอนแก่น
            {
                name: 'ขอนแก่น',
                type: 'province',
                lat: 16.4419,
                lon: 102.8359,
                postal: '40000'
            }, {
                name: 'เมืองขอนแก่น',
                type: 'district',
                province: 'ขอนแก่น',
                lat: 16.4419,
                lon: 102.8359,
                postal: '40000'
            }, {
                name: 'น้ำพอง',
                type: 'district',
                province: 'ขอนแก่น',
                lat: 16.0800,
                lon: 102.8000,
                postal: '40310'
            },

            // นครราชสีมา
            {
                name: 'นครราชสีมา',
                type: 'province',
                lat: 14.9799,
                lon: 102.0977,
                postal: '30000'
            }, {
                name: 'เมืองนครราชสีมา',
                type: 'district',
                province: 'นครราชสีมา',
                lat: 14.9799,
                lon: 102.0977,
                postal: '30000'
            }, {
                name: 'ปากช่อง',
                type: 'district',
                province: 'นครราชสีมา',
                lat: 14.6200,
                lon: 101.4000,
                postal: '30130'
            },

            // อุดรธานี
            {
                name: 'อุดรธานี',
                type: 'province',
                lat: 17.4138,
                lon: 102.7877,
                postal: '41000'
            }, {
                name: 'เมืองอุดรธานี',
                type: 'district',
                province: 'อุดรธานี',
                lat: 17.4138,
                lon: 102.7877,
                postal: '41000'
            },

            // สุราษฎร์ธานี
            {
                name: 'สุราษฎร์ธานี',
                type: 'province',
                lat: 9.1382,
                lon: 99.3215,
                postal: '84000'
            }, {
                name: 'เกาะสมุย',
                type: 'district',
                province: 'สุราษฎร์ธานี',
                lat: 9.5018,
                lon: 99.9648,
                postal: '84140'
            }, {
                name: 'เกาะพะงัน',
                type: 'district',
                province: 'สุราษฎร์ธานี',
                lat: 9.7500,
                lon: 100.0200,
                postal: '84280'
            },

            // ประจวบคีรีขันธ์
            {
                name: 'ประจวบคีรีขันธ์',
                type: 'province',
                lat: 11.8127,
                lon: 99.7973,
                postal: '77000'
            }, {
                name: 'หัวหิน',
                type: 'district',
                province: 'ประจวบคีรีขันธ์',
                lat: 12.5683,
                lon: 99.9576,
                postal: '77110'
            }, {
                name: 'ชะอำ',
                type: 'district',
                province: 'ประจวบคีรีขันธ์',
                lat: 12.7900,
                lon: 99.9700,
                postal: '76120'
            }
        ];

        // Weather conditions - แก้ไข syntax error
        const weatherConditions = {
            0: {
                icon: '☀️',
                desc: 'แจ่มใส',
                severity: 'low'
            },
            1: {
                icon: '🌤️',
                desc: 'เมฆบางส่วน',
                severity: 'low'
            },
            2: {
                icon: '⛅',
                desc: 'เมฆปานกลาง',
                severity: 'low'
            },
            3: {
                icon: '☁️',
                desc: 'มีเมฆมาก',
                severity: 'low'
            },
            45: {
                icon: '🌫️',
                desc: 'หมอก',
                severity: 'medium'
            },
            48: {
                icon: '🌫️',
                desc: 'หมอกแข็ง',
                severity: 'medium'
            },
            51: {
                icon: '🌦️',
                desc: 'ฝนปรอยๆ',
                severity: 'medium'
            },
            53: {
                icon: '🌦️',
                desc: 'ฝนปานกลาง',
                severity: 'medium'
            },
            55: {
                icon: '🌧️',
                desc: 'ฝนหนัก',
                severity: 'high'
            },
            61: {
                icon: '🌧️',
                desc: 'ฝนเล็กน้อย',
                severity: 'medium'
            },
            63: {
                icon: '🌧️',
                desc: 'ฝนปานกลาง',
                severity: 'medium'
            },
            65: {
                icon: '⛈️',
                desc: 'ฝนหนัก',
                severity: 'high'
            },
            80: {
                icon: '🌦️',
                desc: 'ฝนฟ้าคะนอง',
                severity: 'high'
            },
            95: {
                icon: '⛈️',
                desc: 'พายุฝนฟ้าคะนอง',
                severity: 'high'
            },
            96: {
                icon: '⛈️',
                desc: 'พายุฝนฟ้าคะนองพร้อมลูกเห็บ',
                severity: 'high'
            },
            99: {
                icon: '⛈️',
                desc: 'พายุฝนฟ้าคะนองรุนแรง',
                severity: 'high'
            }
        };

        // Translations
        const translations = {
            th: {
                searchPlaceholder: '🔍 ค้นหาทุกที่ในโลก: จังหวัด อำเภอ ตำบล รหัสไปรษณีย์ หรือชื่อเมือง...',
                currentLocation: 'ตำแหน่งปัจจุบัน',
                loading: 'กำลังโหลดข้อมูล...',
                noResults: 'ไม่พบสถานที่ที่ค้นหา',
                addToFavorites: 'เพิ่มในรายการโปรด',
                removeFromFavorites: 'ลบออกจากรายการโปรด'
            },
            en: {
                searchPlaceholder: '🔍 Search anywhere in the world: provinces, districts, postal codes, or city names...',
                currentLocation: 'Current Location',
                loading: 'Loading...',
                noResults: 'No locations found',
                addToFavorites: 'Add to Favorites',
                removeFromFavorites: 'Remove from Favorites'
            }
        };

        // Initialize app
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            loadSettings();
            updateFavorites();
            fetchWeatherData();
            updateLanguage();
        });

        function setupEventListeners() {
            // Search functionality
            const searchInput = document.getElementById('locationSearch');
            searchInput.addEventListener('input', handleSearch);
            searchInput.addEventListener('focus', showSearchDropdown);

            // Voice search
            document.getElementById('voiceSearch').addEventListener('click', handleVoiceSearch);

            // Current location button
            document.getElementById('currentLocationBtn').addEventListener('click', getCurrentLocation);

            // Forecast dropdown
            document.getElementById('forecastDropdown').addEventListener('click', toggleForecastDropdown);
            document.querySelectorAll('#forecastOptions .dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    selectedForecastDays = parseInt(this.dataset.days);
                    document.getElementById('selectedForecast').textContent = this.textContent.trim();
                    document.getElementById('forecastOptions').classList.remove('show');
                    fetchWeatherData();
                });
            });

            // Language selector
            document.getElementById('languageSelect').addEventListener('change', handleLanguageChange);

            // Settings
            document.getElementById('settingsToggle').addEventListener('click', () => {
                document.getElementById('settingsModal').classList.remove('hidden');
            });

            document.getElementById('closeSettings').addEventListener('click', () => {
                document.getElementById('settingsModal').classList.add('hidden');
            });

            document.getElementById('saveSettings').addEventListener('click', saveSettings);

            // Alerts toggle
            document.getElementById('alertsToggle').addEventListener('click', toggleAlerts);

            // Favorites toggle
            document.getElementById('favoritesToggle').addEventListener('click', toggleFavorites);

            // Add to favorites
            document.getElementById('addToFavorites').addEventListener('click', addToFavorites);

            // Quick location buttons
            document.querySelectorAll('#quickLocations button').forEach(btn => {
                btn.addEventListener('click', function() {
                    const lat = parseFloat(this.dataset.lat);
                    const lon = parseFloat(this.dataset.lon);
                    const name = this.dataset.name;

                    currentLat = lat;
                    currentLon = lon;
                    document.getElementById('locationSearch').value = name;
                    hideSearchDropdown();
                    fetchWeatherData();
                });
            });

            // Chart tabs
            document.querySelectorAll('.tab-button').forEach(tab => {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab-button').forEach(t => {
                        t.classList.remove('active');
                    });
                    this.classList.add('active');
                    updateChart(this.dataset.chart);
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('#locationSearch') && !e.target.closest('#searchDropdown')) {
                    hideSearchDropdown();
                }
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-content').forEach(dropdown => {
                        dropdown.classList.remove('show');
                    });
                }
                if (!e.target.closest('#settingsModal') && !e.target.closest('#settingsToggle')) {
                    document.getElementById('settingsModal').classList.add('hidden');
                }
            });
        }

        function toggleForecastDropdown() {
            const dropdown = document.getElementById('forecastOptions');
            dropdown.classList.toggle('show');
        }

        function handleSearch(e) {
            const query = e.target.value.toLowerCase().trim();

            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }

            if (query.length < 2) {
                hideSearchDropdown();
                return;
            }

            document.getElementById('searchLoading').classList.remove('hidden');

            searchTimeout = setTimeout(() => {
                performSearch(query);
            }, 300);
        }

        async function performSearch(query) {
            try {
                // Search local Thai database
                const localResults = thaiLocationsExtended.filter(location =>
                    location.name.toLowerCase().includes(query) ||
                    (location.province && location.province.toLowerCase().includes(query)) ||
                    (location.postal && location.postal.includes(query))
                );

                // Search global locations via API
                let apiResults = [];
                try {
                    const response = await fetch(
                        `https://geocoding-api.open-meteo.com/v1/search?name=${encodeURIComponent(query)}&count=10&language=${currentLanguage}&format=json`
                    );

                    if (response.ok) {
                        const data = await response.json();
                        if (data.results) {
                            apiResults = data.results.map(result => ({
                                name: result.name,
                                type: 'global',
                                lat: result.latitude,
                                lon: result.longitude,
                                province: result.admin1 || '',
                                country: result.country || '',
                                postal: ''
                            }));
                        }
                    }
                } catch (apiError) {
                    console.log('API search failed, using local results only');
                }

                // Combine and deduplicate results
                const allResults = [...localResults, ...apiResults];
                const uniqueResults = allResults.filter((result, index, self) =>
                    index === self.findIndex(r => r.name === result.name && Math.abs(r.lat - result.lat) < 0.01)
                );

                // Sort results by relevance
                const sortedResults = uniqueResults.sort((a, b) => {
                    const aExact = a.name.toLowerCase() === query;
                    const bExact = b.name.toLowerCase() === query;

                    if (aExact && !bExact) return -1;
                    if (!aExact && bExact) return 1;

                    const typeOrder = {
                        province: 0,
                        district: 1,
                        subdistrict: 2,
                        postal: 3,
                        global: 4
                    };
                    return (typeOrder[a.type] || 5) - (typeOrder[b.type] || 5);
                });

                showSearchResults(sortedResults.slice(0, 10));

            } catch (error) {
                console.error('Search error:', error);
                showSearchResults([]);
            } finally {
                document.getElementById('searchLoading').classList.add('hidden');
            }
        }

        function showSearchResults(results) {
            const dropdown = document.getElementById('searchDropdown');
            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = '';

            if (results.length === 0) {
                const t = translations[currentLanguage];
                resultsContainer.innerHTML = `<div class="p-4 text-gray-500 text-center">${t.noResults}</div>`;
            } else {
                results.forEach(location => {
                    const item = document.createElement('div');
                    item.className = 'search-item';

                    let typeTag = '';
                    let typeClass = '';

                    switch (location.type) {
                        case 'province':
                            typeTag = 'จังหวัด';
                            typeClass = 'location-tag tag-province';
                            break;
                        case 'district':
                            typeTag = 'อำเภอ';
                            typeClass = 'location-tag tag-district';
                            break;
                        case 'subdistrict':
                            typeTag = 'ตำบล';
                            typeClass = 'location-tag tag-subdistrict';
                            break;
                        case 'postal':
                            typeTag = 'รหัสไปรษณีย์';
                            typeClass = 'location-tag tag-postal';
                            break;
                        case 'global':
                            typeTag = location.country || 'ทั่วโลก';
                            typeClass = 'location-tag tag-global';
                            break;
                        default:
                            typeTag = 'สถานที่';
                            typeClass = 'location-tag tag-global';
                    }

                    const provinceText = location.province && location.type !== 'province' ?
                        `<span class="text-gray-500 text-sm ml-2">${location.province}</span>` :
                        '';

                    const postalText = location.postal ?
                        `<span class="text-gray-400 text-xs ml-2">${location.postal}</span>` :
                        '';

                    item.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-3"></i>
                                <div>
                                    <div class="font-medium text-gray-900">${location.name}</div>
                                    <div class="flex items-center">
                                        ${provinceText}
                                        ${postalText}
                                    </div>
                                </div>
                            </div>
                            <span class="${typeClass}">${typeTag}</span>
                        </div>
                    `;

                    item.addEventListener('click', () => selectLocation(location));
                    resultsContainer.appendChild(item);
                });
            }

            dropdown.classList.remove('hidden');
        }

        function showSearchDropdown() {
            const dropdown = document.getElementById('searchDropdown');
            if (dropdown.children.length > 0) {
                dropdown.classList.remove('hidden');
            }
        }

        function hideSearchDropdown() {
            document.getElementById('searchDropdown').classList.add('hidden');
        }

        function selectLocation(location) {
            const displayName = location.province && location.type !== 'province' ?
                `${location.name}, ${location.province}` :
                location.name;

            document.getElementById('locationSearch').value = displayName;
            currentLat = location.lat;
            currentLon = location.lon;
            hideSearchDropdown();
            fetchWeatherData();
        }

        function handleVoiceSearch() {
            if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                const recognition = new SpeechRecognition();

                recognition.lang = currentLanguage === 'th' ? 'th-TH' : 'en-US';
                recognition.continuous = false;
                recognition.interimResults = false;

                recognition.onstart = function() {
                    document.getElementById('voiceSearch').innerHTML = '<i class="fas fa-microphone-slash text-red-500"></i>';
                    showNotification('กำลังฟัง...', 'info');
                };

                recognition.onresult = function(event) {
                    const transcript = event.results[0][0].transcript;
                    document.getElementById('locationSearch').value = transcript;
                    handleSearch({
                        target: {
                            value: transcript
                        }
                    });
                };

                recognition.onerror = function(event) {
                    showNotification('ไม่สามารถใช้งานการค้นหาด้วยเสียงได้', 'error');
                };

                recognition.onend = function() {
                    document.getElementById('voiceSearch').innerHTML = '<i class="fas fa-microphone"></i>';
                };

                recognition.start();
            } else {
                showNotification('เบราว์เซอร์ไม่รองรับการค้นหาด้วยเสียง', 'error');
            }
        }

        function getCurrentLocation() {
            if (navigator.geolocation) {
                showLoading();
                navigator.geolocation.getCurrentPosition(
                    async position => {
                        currentLat = position.coords.latitude;
                        currentLon = position.coords.longitude;

                        try {
                            const response = await fetch(
                                `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${currentLat}&longitude=${currentLon}&localityLanguage=${currentLanguage}`
                            );

                            if (response.ok) {
                                const data = await response.json();
                                const locationName = data.city || data.locality || data.principalSubdivision || 'ตำแหน่งปัจจุบัน';
                                document.getElementById('locationSearch').value = locationName;
                            }
                        } catch (error) {
                            document.getElementById('locationSearch').value = 'ตำแหน่งปัจจุบัน';
                        }

                        fetchWeatherData();
                        showNotification('ได้รับตำแหน่งปัจจุบันแล้ว', 'success');
                    },
                    error => {
                        hideLoading();
                        showNotification('ไม่สามารถเข้าถึงตำแหน่งปัจจุบันได้', 'error');
                    }
                );
            } else {
                showNotification('เบราว์เซอร์ไม่รองรับการระบุตำแหน่ง', 'error');
            }
        }

        function handleLanguageChange(e) {
            currentLanguage = e.target.value;
            updateLanguage();
            fetchWeatherData();
        }

        function updateLanguage() {
            const t = translations[currentLanguage];
            document.getElementById('locationSearch').placeholder = t.searchPlaceholder;
            document.getElementById('currentLocationBtn').innerHTML = `<i class="fas fa-location-arrow mr-2"></i>${t.currentLocation}`;
        }

        function toggleAlerts() {
            const alertsSection = document.getElementById('weatherAlerts');
            alertsSection.classList.toggle('hidden');

            if (!alertsSection.classList.contains('hidden')) {
                checkWeatherAlerts();
            }
        }

        function toggleFavorites() {
            const favoritesSection = document.getElementById('favoritesSection');
            favoritesSection.classList.toggle('hidden');
            updateFavorites();
        }

        function addToFavorites() {
            const locationName = document.getElementById('locationSearch').value || 'ตำแหน่งที่เลือก';
            const favorite = {
                name: locationName,
                lat: currentLat,
                lon: currentLon,
                timestamp: Date.now()
            };

            const exists = favorites.some(fav =>
                Math.abs(fav.lat - currentLat) < 0.01 && Math.abs(fav.lon - currentLon) < 0.01
            );

            if (!exists) {
                favorites.push(favorite);
                localStorage.setItem('weatherFavorites', JSON.stringify(favorites));
                updateFavorites();
                showNotification('เพิ่มในรายการโปรดแล้ว', 'success');

                const btn = document.getElementById('addToFavorites');
                btn.innerHTML = '<i class="fas fa-heart-broken mr-2"></i>ลบออกจากรายการโปรด';
                btn.onclick = removeFromFavorites;
            }
        }

        function removeFromFavorites() {
            favorites = favorites.filter(fav =>
                !(Math.abs(fav.lat - currentLat) < 0.01 && Math.abs(fav.lon - currentLon) < 0.01)
            );
            localStorage.setItem('weatherFavorites', JSON.stringify(favorites));
            updateFavorites();
            showNotification('ลบออกจากรายการโปรดแล้ว', 'success');

            const btn = document.getElementById('addToFavorites');
            btn.innerHTML = '<i class="fas fa-heart mr-2"></i>เพิ่มในรายการโปรด';
            btn.onclick = addToFavorites;
        }

        function updateFavorites() {
            const favoritesList = document.getElementById('favoritesList');
            favoritesList.innerHTML = '';

            if (favorites.length === 0) {
                favoritesList.innerHTML = '<div class="text-gray-500 text-sm">ยังไม่มีสถานที่โปรด</div>';
                return;
            }

            favorites.forEach(favorite => {
                const btn = document.createElement('button');
                btn.className = 'btn-secondary text-sm';
                btn.innerHTML = `❤️ ${favorite.name}`;
                btn.addEventListener('click', () => {
                    currentLat = favorite.lat;
                    currentLon = favorite.lon;
                    document.getElementById('locationSearch').value = favorite.name;
                    fetchWeatherData();
                });
                favoritesList.appendChild(btn);
            });

            const exists = favorites.some(fav =>
                Math.abs(fav.lat - currentLat) < 0.01 && Math.abs(fav.lon - currentLon) < 0.01
            );

            const btn = document.getElementById('addToFavorites');
            if (exists) {
                btn.innerHTML = '<i class="fas fa-heart-broken mr-2"></i>ลบออกจากรายการโปรด';
                btn.onclick = removeFromFavorites;
            } else {
                btn.innerHTML = '<i class="fas fa-heart mr-2"></i>เพิ่มในรายการโปรด';
                btn.onclick = addToFavorites;
            }
        }

        function loadSettings() {
            document.getElementById('tempUnit').value = settings.tempUnit;
            document.getElementById('windUnit').value = settings.windUnit;
            document.getElementById('rainAlerts').checked = settings.rainAlerts;
            document.getElementById('tempAlerts').checked = settings.tempAlerts;
        }

        function saveSettings() {
            settings = {
                tempUnit: document.getElementById('tempUnit').value,
                windUnit: document.getElementById('windUnit').value,
                rainAlerts: document.getElementById('rainAlerts').checked,
                tempAlerts: document.getElementById('tempAlerts').checked
            };

            localStorage.setItem('weatherSettings', JSON.stringify(settings));
            document.getElementById('settingsModal').classList.add('hidden');
            showNotification('บันทึกการตั้งค่าแล้ว', 'success');

            if (currentWeatherData) {
                updateWeatherDisplay(currentWeatherData);
            }
        }

        function showNotification(message, type = 'info') {
            const container = document.getElementById('notificationContainer');
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <div class="flex items-center justify-between">
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            container.appendChild(notification);

            setTimeout(() => {
                notification.classList.add('show');
            }, 100);

            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 400);
            }, 5000);
        }

        function showLoading() {
            document.getElementById('loadingIndicator').classList.remove('hidden');
            document.getElementById('currentWeather').classList.add('hidden');
            document.getElementById('weatherHighlights').classList.add('hidden');
            document.getElementById('hourlyForecast').classList.add('hidden');
            document.getElementById('weeklyForecast').classList.add('hidden');
            document.getElementById('additionalInfo').classList.add('hidden');
        }

        function hideLoading() {
            document.getElementById('loadingIndicator').classList.add('hidden');
        }

        async function fetchWeatherData() {
            showLoading();

            try {
                const today = new Date();
                const selectedDate = new Date(today);
                selectedDate.setDate(today.getDate() + selectedForecastDays);
                const selectedDateStr = selectedDate.toISOString().split('T')[0];

                const endDate = new Date(selectedDate);
                endDate.setDate(selectedDate.getDate() + 6);
                const endDateStr = endDate.toISOString().split('T')[0];

                const url = `https://api.open-meteo.com/v1/forecast?latitude=${currentLat}&longitude=${currentLon}&current=temperature_2m,relative_humidity_2m,wind_speed_10m,weather_code,surface_pressure&hourly=temperature_2m,relative_humidity_2m,wind_speed_10m,weather_code,surface_pressure&daily=sunrise,sunset,uv_index_max,temperature_2m_max,temperature_2m_min,weather_code&timezone=auto&start_date=${selectedDateStr}&end_date=${endDateStr}`;

                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                currentWeatherData = data;

                updateWeatherDisplay(data);
                updateHourlyChart(data);
                updateWeatherHighlights(data);
                updateAdditionalInfo(data);
                updateWeeklyForecast(data);
                checkWeatherAlerts(data);

            } catch (error) {
                console.error('Error fetching weather data:', error);
                showNotification('เกิดข้อผิดพลาดในการโหลดข้อมูลสภาพอากาศ กรุณาลองใหม่อีกครั้ง', 'error');
            } finally {
                hideLoading();
            }
        }

        function updateWeatherDisplay(data) {
            try {
                const current = data.current;
                const condition = weatherConditions[current.weather_code] || weatherConditions[0];

                const locationName = document.getElementById('locationSearch').value || 'ตำแหน่งที่เลือก';
                document.getElementById('locationName').textContent = locationName;

                const temp = convertTemperature(current.temperature_2m);
                const feelsLike = convertTemperature(current.temperature_2m + 3);

                document.getElementById('currentTemp').textContent = `${Math.round(temp)}°${settings.tempUnit === 'celsius' ? 'C' : 'F'}`;
                document.getElementById('feelsLike').textContent = `รู้สึกเหมือน ${Math.round(feelsLike)}°${settings.tempUnit === 'celsius' ? 'C' : 'F'}`;
                document.getElementById('weatherIcon').textContent = condition.icon;
                document.getElementById('weatherDescription').textContent = condition.desc;
                document.getElementById('humidity').textContent = `${current.relative_humidity_2m}%`;

                const windSpeed = convertWindSpeed(current.wind_speed_10m);
                const windUnit = getWindUnit();
                document.getElementById('windSpeed').textContent = `${Math.round(windSpeed)} ${windUnit}`;

                document.getElementById('visibility').textContent = '10 km';
                document.getElementById('pressure').textContent = `${Math.round(current.surface_pressure)} hPa`;

                // Update additional weather info
                const dewPoint = current.temperature_2m - ((100 - current.relative_humidity_2m) / 5);
                document.getElementById('dewPoint').textContent = `${Math.round(convertTemperature(dewPoint))}°${settings.tempUnit === 'celsius' ? 'C' : 'F'}`;

                const now = new Date();
                document.getElementById('currentTime').textContent = now.toLocaleString('th-TH', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Update sunrise/sunset
                if (data.daily && data.daily.sunrise && data.daily.sunset) {
                    const sunrise = new Date(data.daily.sunrise[0]);
                    const sunset = new Date(data.daily.sunset[0]);
                    const dayLength = sunset - sunrise;
                    const hours = Math.floor(dayLength / (1000 * 60 * 60));
                    const minutes = Math.floor((dayLength % (1000 * 60 * 60)) / (1000 * 60));

                    document.getElementById('sunrise').textContent = sunrise.toLocaleTimeString('th-TH', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    document.getElementById('sunset').textContent = sunset.toLocaleTimeString('th-TH', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    document.getElementById('dayLength').textContent = `${hours} ชม. ${minutes} นาที`;
                }

                // Update UV Index
                if (data.daily && data.daily.uv_index_max) {
                    const uvIndex = data.daily.uv_index_max[0] || 0;
                    document.getElementById('uvIndex').textContent = Math.round(uvIndex);
                }

                document.getElementById('currentWeather').classList.remove('hidden');

            } catch (error) {
                console.error('Error updating weather display:', error);
                showNotification('เกิดข้อผิดพลาดในการแสดงข้อมูลสภาพอากาศ', 'error');
            }
        }

        function updateHourlyChart(data) {
            try {
                const selectedDate = new Date();
                selectedDate.setDate(selectedDate.getDate() + selectedForecastDays);
                const selectedDateStr = selectedDate.toISOString().split('T')[0];

                const hourlyData = data.hourly.time
                    .map((time, index) => {
                        const date = new Date(time);
                        if (date.toISOString().split('T')[0] === selectedDateStr) {
                            return {
                                time: date,
                                temperature: data.hourly.temperature_2m[index],
                                humidity: data.hourly.relative_humidity_2m[index],
                                windSpeed: data.hourly.wind_speed_10m[index],
                                pressure: data.hourly.surface_pressure[index],
                                weatherCode: data.hourly.weather_code[index]
                            };
                        }
                        return null;
                    })
                    .filter(Boolean);

                updateChart('temperature', hourlyData);
                updateHourlyCards(hourlyData);

                document.getElementById('hourlyForecast').classList.remove('hidden');

            } catch (error) {
                console.error('Error updating hourly chart:', error);
            }
        }

        function updateChart(type, hourlyData = null) {
            try {
                if (!hourlyData && currentWeatherData) {
                    const selectedDate = new Date();
                    selectedDate.setDate(selectedDate.getDate() + selectedForecastDays);
                    const selectedDateStr = selectedDate.toISOString().split('T')[0];

                    hourlyData = currentWeatherData.hourly.time
                        .map((time, index) => {
                            const date = new Date(time);
                            if (date.toISOString().split('T')[0] === selectedDateStr) {
                                return {
                                    time: date,
                                    temperature: currentWeatherData.hourly.temperature_2m[index],
                                    humidity: currentWeatherData.hourly.relative_humidity_2m[index],
                                    windSpeed: currentWeatherData.hourly.wind_speed_10m[index],
                                    pressure: currentWeatherData.hourly.surface_pressure[index]
                                };
                            }
                            return null;
                        })
                        .filter(Boolean);
                }

                if (!hourlyData || hourlyData.length === 0) return;

                const ctx = document.getElementById('weatherChart').getContext('2d');

                if (weatherChart) {
                    weatherChart.destroy();
                }

                let chartData, label, color, unit;

                switch (type) {
                    case 'temperature':
                        chartData = hourlyData.map(item => convertTemperature(item.temperature));
                        label = 'อุณหภูมิ';
                        color = '#2563eb';
                        unit = settings.tempUnit === 'celsius' ? '°C' : '°F';
                        break;
                    case 'humidity':
                        chartData = hourlyData.map(item => item.humidity);
                        label = 'ความชื้น';
                        color = '#10b981';
                        unit = '%';
                        break;
                    case 'wind':
                        chartData = hourlyData.map(item => convertWindSpeed(item.windSpeed));
                        label = 'ความเร็วลม';
                        color = '#3b82f6';
                        unit = getWindUnit();
                        break;
                    case 'pressure':
                        chartData = hourlyData.map(item => item.pressure);
                        label = 'ความกดอากาศ';
                        color = '#8b5cf6';
                        unit = 'hPa';
                        break;
                }

                weatherChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: hourlyData.map(item => item.time.getHours() + ':00'),
                        datasets: [{
                            label: `${label} (${unit})`,
                            data: chartData,
                            borderColor: color,
                            backgroundColor: color + '20',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: color,
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                labels: {
                                    color: '#1f2937',
                                    font: {
                                        size: 14,
                                        weight: '600'
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#ffffff',
                                bodyColor: '#ffffff',
                                borderColor: color,
                                borderWidth: 1
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: '#4b5563',
                                    font: {
                                        size: 12,
                                        weight: '500'
                                    }
                                },
                                grid: {
                                    color: 'rgba(107, 114, 128, 0.2)'
                                }
                            },
                            y: {
                                ticks: {
                                    color: '#4b5563',
                                    font: {
                                        size: 12,
                                        weight: '500'
                                    },
                                    callback: function(value) {
                                        return value + unit;
                                    }
                                },
                                grid: {
                                    color: 'rgba(107, 114, 128, 0.2)'
                                }
                            }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeInOutQuart'
                        }
                    }
                });

            } catch (error) {
                console.error('Error updating chart:', error);
            }
        }

        function updateHourlyCards(hourlyData) {
            try {
                const container = document.getElementById('hourlyCards');
                container.innerHTML = '';

                hourlyData.forEach((item, index) => {
                    const condition = weatherConditions[item.weatherCode] || weatherConditions[0];
                    const temp = convertTemperature(item.temperature);
                    const tempUnit = settings.tempUnit === 'celsius' ? '°C' : '°F';

                    const card = document.createElement('div');
                    card.className = 'flex-shrink-0 weather-card p-4 text-center min-w-[120px] hover:shadow-lg transition-all';

                    card.innerHTML = `
                        <div class="text-gray-600 text-sm font-medium mb-2">${item.time.getHours()}:00</div>
                        <div class="text-3xl mb-2">${condition.icon}</div>
                        <div class="text-gray-900 font-bold text-lg">${Math.round(temp)}${tempUnit}</div>
                        <div class="text-gray-500 text-xs mt-1">${item.humidity}%</div>
                    `;

                    container.appendChild(card);
                });

            } catch (error) {
                console.error('Error updating hourly cards:', error);
            }
        }

        function updateWeatherHighlights(data) {
            try {
                const selectedDate = new Date();
                selectedDate.setDate(selectedDate.getDate() + selectedForecastDays);
                const selectedDateStr = selectedDate.toISOString().split('T')[0];

                const hourlyData = data.hourly.time
                    .map((time, index) => {
                        const date = new Date(time);
                        if (date.toISOString().split('T')[0] === selectedDateStr) {
                            return {
                                time: date,
                                temperature: data.hourly.temperature_2m[index],
                                humidity: data.hourly.relative_humidity_2m[index],
                                windSpeed: data.hourly.wind_speed_10m[index],
                                pressure: data.hourly.surface_pressure[index]
                            };
                        }
                        return null;
                    })
                    .filter(Boolean);

                if (hourlyData.length === 0) return;

                const maxTemp = Math.max(...hourlyData.map(item => item.temperature));
                const minTemp = Math.min(...hourlyData.map(item => item.temperature));
                const maxWind = Math.max(...hourlyData.map(item => item.windSpeed));
                const avgHumidity = hourlyData.reduce((sum, item) => sum + item.humidity, 0) / hourlyData.length;

                const highlights = [{
                    icon: 'fas fa-thermometer-full',
                    title: 'อุณหภูมิสูงสุด',
                    value: `${Math.round(convertTemperature(maxTemp))}°${settings.tempUnit === 'celsius' ? 'C' : 'F'}`,
                    color: 'text-red-600',
                    bgColor: 'bg-red-50',
                    borderColor: 'border-red-200'
                }, {
                    icon: 'fas fa-thermometer-empty',
                    title: 'อุณหภูมิต่ำสุด',
                    value: `${Math.round(convertTemperature(minTemp))}°${settings.tempUnit === 'celsius' ? 'C' : 'F'}`,
                    color: 'text-blue-600',
                    bgColor: 'bg-blue-50',
                    borderColor: 'border-blue-200'
                }, {
                    icon: 'fas fa-wind',
                    title: 'ลมแรงสุด',
                    value: `${Math.round(convertWindSpeed(maxWind))} ${getWindUnit()}`,
                    color: 'text-green-600',
                    bgColor: 'bg-green-50',
                    borderColor: 'border-green-200'
                }, {
                    icon: 'fas fa-tint',
                    title: 'ความชื้นเฉลี่ย',
                    value: `${Math.round(avgHumidity)}%`,
                    color: 'text-purple-600',
                    bgColor: 'bg-purple-50',
                    borderColor: 'border-purple-200'
                }];

                const grid = document.getElementById('highlightsGrid');
                grid.innerHTML = '';

                highlights.forEach((highlight, index) => {
                    const item = document.createElement('div');
                    item.className = `${highlight.bgColor} border ${highlight.borderColor} rounded-lg p-6 text-center hover:shadow-md transition-all`;

                    item.innerHTML = `
                        <i class="${highlight.icon} ${highlight.color} text-2xl mb-4"></i>
                        <div class="text-gray-700 text-sm font-medium mb-2">${highlight.title}</div>
                        <div class="text-gray-900 font-bold text-xl">${highlight.value}</div>
                    `;
                    grid.appendChild(item);
                });

                document.getElementById('weatherHighlights').classList.remove('hidden');

            } catch (error) {
                console.error('Error updating weather highlights:', error);
            }
        }

        function updateWeeklyForecast(data) {
            try {
                const grid = document.getElementById('weeklyGrid');
                grid.innerHTML = '';

                if (!data.daily || !data.daily.time) return;

                data.daily.time.forEach((date, index) => {
                    const dayDate = new Date(date);
                    const condition = weatherConditions[data.daily.weather_code[index]] || weatherConditions[0];
                    const maxTemp = convertTemperature(data.daily.temperature_2m_max[index]);
                    const minTemp = convertTemperature(data.daily.temperature_2m_min[index]);

                    const dayName = dayDate.toLocaleDateString('th-TH', {
                        weekday: 'short'
                    });
                    const dayNumber = dayDate.getDate();

                    const card = document.createElement('div');
                    card.className = 'weather-card p-4 text-center hover:shadow-lg transition-all';

                    card.innerHTML = `
                        <div class="text-gray-600 text-sm font-medium mb-2">${dayName}</div>
                        <div class="text-gray-900 font-bold text-lg mb-2">${dayNumber}</div>
                        <div class="text-3xl mb-3">${condition.icon}</div>
                        <div class="text-gray-900 font-bold">${Math.round(maxTemp)}°</div>
                        <div class="text-gray-500 text-sm">${Math.round(minTemp)}°</div>
                    `;

                    grid.appendChild(card);
                });

                document.getElementById('weeklyForecast').classList.remove('hidden');

            } catch (error) {
                console.error('Error updating weekly forecast:', error);
            }
        }

        function updateAdditionalInfo(data) {
            try {
                // Air quality display (simulated)
                const airQualityLevel = Math.floor(Math.random() * 4);
                const airQualityData = [{
                    level: 'ดีเยี่ยม',
                    value: 15,
                    color: 'text-green-600',
                    width: '20%',
                    desc: 'ปลอดภัยสำหรับทุกกิจกรรม'
                }, {
                    level: 'ดี',
                    value: 35,
                    color: 'text-blue-600',
                    width: '40%',
                    desc: 'ปลอดภัยสำหรับกิจกรรมกลางแจ้ง'
                }, {
                    level: 'ปานกลาง',
                    value: 65,
                    color: 'text-yellow-600',
                    width: '60%',
                    desc: 'ควรระวังสำหรับผู้ที่มีปัญหาทางเดินหายใจ'
                }, {
                    level: 'ไม่ดี',
                    value: 85,
                    color: 'text-red-600',
                    width: '80%',
                    desc: 'หลีกเลี่ยงกิจกรรมกลางแจ้ง'
                }][airQualityLevel];

                document.getElementById('airQuality').innerHTML = `
                    <div class="text-4xl md:text-5xl font-bold ${airQualityData.color} mb-4">${airQualityData.level}</div>
                    <div class="text-gray-700 text-base md:text-lg mb-4">PM2.5: ${airQualityData.value} μg/m³</div>
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                        <div class="${airQualityData.color.replace('text-', 'bg-')} h-3 rounded-full transition-all duration-1000" style="width: ${airQualityData.width}"></div>
                    </div>
                    <div class="text-gray-600 text-sm">${airQualityData.desc}</div>
                `;

                // UV Index display
                if (data.daily && data.daily.uv_index_max) {
                    const uvIndex = data.daily.uv_index_max[0] || 7;
                    let uvLevel = 'ปานกลาง';
                    let uvColor = 'text-yellow-600';
                    let uvWidth = '50%';
                    let uvDesc = 'ใช้ครีมกันแดด SPF 15+';

                    if (uvIndex >= 11) {
                        uvLevel = 'อันตรายมาก';
                        uvColor = 'text-purple-600';
                        uvWidth = '100%';
                        uvDesc = 'หลีกเลี่ยงการออกแดด';
                    } else if (uvIndex >= 8) {
                        uvLevel = 'สูงมาก';
                        uvColor = 'text-red-600';
                        uvWidth = '80%';
                        uvDesc = 'ใช้ครีมกันแดด SPF 50+';
                    } else if (uvIndex >= 6) {
                        uvLevel = 'สูง';
                        uvColor = 'text-orange-600';
                        uvWidth = '70%';
                        uvDesc = 'ใช้ครีมกันแดด SPF 30+';
                    } else if (uvIndex >= 3) {
                        uvLevel = 'ปานกลาง';
                        uvColor = 'text-yellow-600';
                        uvWidth = '50%';
                        uvDesc = 'ใช้ครีมกันแดด SPF 15+';
                    } else {
                        uvLevel = 'ต่ำ';
                        uvColor = 'text-green-600';
                        uvWidth = '30%';
                        uvDesc = 'ปลอดภัยจากรังสี UV';
                    }

                    document.getElementById('uvIndexCard').innerHTML = `
                        <div class="text-4xl md:text-5xl font-bold ${uvColor} mb-4">${Math.round(uvIndex)}</div>
                        <div class="text-gray-700 text-base md:text-lg mb-4">${uvLevel}</div>
                        <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                            <div class="${uvColor.replace('text-', 'bg-')} h-3 rounded-full transition-all duration-1000" style="width: ${uvWidth}"></div>
                        </div>
                        <div class="text-gray-600 text-sm">${uvDesc}</div>
                    `;
                }

                document.getElementById('additionalInfo').classList.remove('hidden');

            } catch (error) {
                console.error('Error updating additional info:', error);
            }
        }

        function checkWeatherAlerts(data = currentWeatherData) {
            try {
                if (!data || !settings.rainAlerts && !settings.tempAlerts) return;

                const current = data.current;
                const condition = weatherConditions[current.weather_code] || weatherConditions[0];
                let alertMessage = '';
                let hasAlert = false;

                if (settings.rainAlerts && condition.severity === 'high') {
                    alertMessage = `⚠️ ${condition.desc} - โปรดระวังและหลีกเลี่ยงการเดินทางที่ไม่จำเป็น`;
                    hasAlert = true;
                }

                if (settings.tempAlerts) {
                    const temp = current.temperature_2m;
                    if (temp >= 40) {
                        alertMessage = `🌡️ อุณหภูมิสูงมาก ${Math.round(temp)}°C - โปรดดื่มน้ำมากๆ และหลีกเลี่ยงการออกแดด`;
                        hasAlert = true;
                    } else if (temp <= 15) {
                        alertMessage = `❄️ อุณหภูมิต่ำ ${Math.round(temp)}°C - โปรดแต่งกายให้อบอุ่น`;
                        hasAlert = true;
                    }
                }

                const alertsSection = document.getElementById('weatherAlerts');
                const alertBadge = document.getElementById('alertBadge');

                if (hasAlert) {
                    document.getElementById('alertMessage').textContent = alertMessage;
                    alertsSection.classList.remove('hidden');
                    alertBadge.classList.remove('hidden');
                } else {
                    alertsSection.classList.add('hidden');
                    alertBadge.classList.add('hidden');
                }

            } catch (error) {
                console.error('Error checking weather alerts:', error);
            }
        }

        // Utility functions
        function convertTemperature(celsius) {
            return settings.tempUnit === 'fahrenheit' ? (celsius * 9 / 5) + 32 : celsius;
        }

        function convertWindSpeed(kmh) {
            switch (settings.windUnit) {
                case 'ms':
                    return kmh / 3.6;
                case 'mph':
                    return kmh * 0.621371;
                default:
                    return kmh;
            }
        }

        function getWindUnit() {
            switch (settings.windUnit) {
                case 'ms':
                    return 'm/s';
                case 'mph':
                    return 'mph';
                default:
                    return 'km/h';
            }
        }
    </script>
</body>

</html>
