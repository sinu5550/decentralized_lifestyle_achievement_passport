<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lifestyle Time Visualization</title>
    <link rel="stylesheet" href="../assets/css/visual.css" />
    <link rel="stylesheet" href="../assets/css/menuStyle.css" />
</head>
<body>

  <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
    <div class="main-content">
        <div class="header-section">
            <h2>Lifestyle Time Visualization</h2>
            <p>Track how you spend your time daily</p>
        </div>

        <div class="visualization-grid">
            <div class="card data-card">
                <div class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#5b4df5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span>Daily Time Allocation (Hours)</span>
                </div>

                <div class="input-list">
                    <div class="time-input-group">
                        <label>Work</label>
                        <input type="number" id="time_work" placeholder="e.g. 8" min="0" max="24">
                        <span class="unit">h</span>
                    </div>
                    <div class="time-input-group">
                        <label>Sleep</label>
                        <input type="number" id="time_sleep" placeholder="e.g. 7" min="0" max="24">
                        <span class="unit">h</span>
                    </div>
                    <div class="time-input-group">
                        <label>Exercise</label>
                        <input type="number" id="time_exercise" placeholder="e.g. 1" min="0" max="24">
                        <span class="unit">h</span>
                    </div>
                    <div class="time-input-group">
                        <label>Social</label>
                        <input type="number" id="time_social" placeholder="e.g. 2" min="0" max="24">
                        <span class="unit">h</span>
                    </div>
                    <div class="time-input-group">
                        <label>Learning</label>
                        <input type="number" id="time_learning" placeholder="e.g. 3" min="0" max="24">
                        <span class="unit">h</span>
                    </div>
                    <div class="time-input-group">
                        <label>Leisure</label>
                        <input type="number" id="time_leisure" placeholder="e.g. 2" min="0" max="24">
                        <span class="unit">h</span>
                    </div>
                    <div class="time-input-group">
                        <label>Other</label>
                        <input type="number" id="time_other" placeholder="e.g. 1" min="0" max="24">
                        <span class="unit">h</span>
                    </div>
                </div>

                <div class="total-bar">
                    <span>Total Hours:</span>
                    <span class="hours-count">0 / 24 hours</span>
                </div>

                <button class="save-time-btn" id="saveTimeBtn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Visualize Data
                </button>
            </div>

            <div class="card chart-card">
                <div class="chart-header">
                    <span>Visualization</span>
                </div>
                
                <div class="chart-placeholder">
                    <div class="empty-state" id="chart_empty_state">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <p>Add time allocation to see visualization</p>
                    </div>
                    <canvas id="timePieChart" style="display:none; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../assets/js/rumaiyaScript.js"></script>
</body>
</html>