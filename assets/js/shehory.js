document.addEventListener('DOMContentLoaded', loadLogs);

function sendAjaxRequest(method, url, params, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.open(method, url, true);
    if (method === 'POST') {
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            callback(JSON.parse(xhttp.responseText));
        }
    };
    xhttp.send(params);
}

function loadLogs() {
    sendAjaxRequest('GET', '../controllers/activityController.php', null, function (logs) {
        renderLogs(logs);
    });
}

function renderLogs(logs) {
    var container = document.getElementById('logList');
    if (logs.length === 0) {
        container.innerHTML = '<div class="empty-state">No activities recorded yet</div>';
        return;
    }

    var html = '<table class="activity-table"><thead><tr><th>Action</th><th>Date & Time</th></tr></thead><tbody>';

    for (var i = 0; i < logs.length; i++) {
        html += '<tr class="activity-row">';
        html += '<td class="activity-cell">' + logs[i].action + '</td>';
        html += '<td class="activity-cell">' + logs[i].timestamp + '</td>';
        html += '</tr>';
    }

    html += '</tbody></table>';
    container.innerHTML = html;
}

function clearLogs() {
    if (!confirm('Are you sure you want to clear your activity history?')) return;

    sendAjaxRequest('POST', '../controllers/activityController.php', 'action=clear_logs', function (response) {
        if (response.success) {
            loadLogs();
        } else {
            alert('Failed to clear logs');
        }
    });
}



function loadLearningItems() {
    if (!document.getElementById('learningList')) return;

    sendAjaxRequest('GET', '../controllers/learningController.php', null, function (items) {
        renderLearningItems(items);
    });
}

function renderLearningItems(items) {
    var container = document.getElementById('learningList');
    if (items.length === 0) {
        container.innerHTML = '<p style="grid-column: 1/-1; text-align:center; color:#999;">No learning items yet. Add one!</p>';
        return;
    }

    var html = '';
    for (var i = 0; i < items.length; i++) {
        var progress = items[i].progress;
        var totalUnits = items[i].total_units;
        var currentUnit = items[i].current_unit;

        html += '<div class="learning-card">';
        html += '<div class="card-title">' + items[i].title + '</div>';
        html += '<div class="card-type">' + items[i].type + '</div>';

        html += '<div class="progress-container">';
        html += '<div class="progress-bar" style="width: ' + progress + '%"></div>';
        html += '</div>';

        html += '<div class="card-actions">';
        html += '<div style="display:flex; align-items:center; gap:5px;">';

        if (totalUnits && totalUnits > 0) {
            html += '<input type="number" class="input-progress" style="width:50px" min="0" max="' + totalUnits + '" value="' + currentUnit + '" onchange="updateProgress(' + items[i].id + ', this.value)">';
            html += '<span style="font-size:12px; color:#666"> / ' + totalUnits + '</span>';
        } else {
            html += '<input type="number" class="input-progress" min="0" max="100" value="' + progress + '" onchange="updateProgress(' + items[i].id + ', this.value)">';
            html += '<span style="font-size:12px; color:#666">%</span>';
        }

        html += '</div>';
        html += '<button class="delete-btn" onclick="deleteLearningItem(' + items[i].id + ')">Remove</button>';
        html += '</div>';

        html += '</div>';
    }
    container.innerHTML = html;
}

function openAddModal() {
    document.getElementById('addModal').style.display = 'block';
}

function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

function submitLearningItem() {
    var title = document.getElementById('learnTitle').value;
    var type = document.getElementById('learnType').value;
    var totalUnits = document.getElementById('learnTotalUnits').value;

    if (!title) {
        alert('Please enter a title');
        return;
    }

    var params = 'action=add&title=' + encodeURIComponent(title) + '&type=' + encodeURIComponent(type) + '&total_units=' + encodeURIComponent(totalUnits);

    sendAjaxRequest('POST', '../controllers/learningController.php', params, function (response) {
        if (response.success) {
            closeAddModal();
            document.getElementById('learnTitle').value = '';
            document.getElementById('learnTotalUnits').value = '';
            loadLearningItems();
        } else {
            alert('Failed to add item');
        }
    });
}

function updateProgress(id, newProgress) {
    if (newProgress < 0) newProgress = 0;


    sendAjaxRequest('POST', '../controllers/learningController.php', 'action=update_progress&id=' + id + '&progress=' + newProgress, function (response) {
        if (response.success) {
            loadLearningItems();
        } else {
            alert('Failed to update progress');
        }
    });
}

function deleteLearningItem(id) {
    if (!confirm('Are you sure you want to remove this item?')) return;

    sendAjaxRequest('POST', '../controllers/learningController.php', 'action=delete&id=' + id, function (response) {
        if (response.success) {
            loadLearningItems();
        } else {
            alert('Failed to delete item');
        }
    });
}


window.onclick = function (event) {
    var modal = document.getElementById('addModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



function loadSocialImpacts() {
    if (!document.getElementById('socialList')) return;
    sendAjaxRequest('GET', '../controllers/socialController.php', null, function (items) {
        renderSocialImpacts(items);
    });
}

function renderSocialImpacts(items) {
    var container = document.getElementById('socialList');
    if (items.length === 0) {
        container.innerHTML = '<p style="grid-column: 1/-1; text-align:center; color:#999;">No social impacts recorded yet. Be the change!</p>';
        return;
    }

    var html = '';
    for (var i = 0; i < items.length; i++) {
        html += '<div class="social-card">';
        html += '<div class="card-type">' + items[i].type + '</div>';
        html += '<div class="card-title">' + items[i].title + '</div>';

        if (items[i].metric_value) {
            html += '<div class="card-metric">' + items[i].metric_value + '</div>';
        }

        if (items[i].description) {
            html += '<div class="card-desc">' + items[i].description + '</div>';
        }

        html += '<div class="card-date">Date: ' + items[i].impact_date + '</div>';

        html += '<div class="card-actions">';
        html += '<button class="delete-btn" onclick="deleteSocialImpact(' + items[i].id + ')">Remove</button>';
        html += '</div>';

        html += '</div>';
    }
    container.innerHTML = html;
}

function openSocialModal() {
    document.getElementById('socialModal').style.display = 'block';
}

function closeSocialModal() {
    document.getElementById('socialModal').style.display = 'none';
}

function submitSocialImpact() {
    var title = document.getElementById('socialTitle').value;
    var type = document.getElementById('socialType').value;
    var metric = document.getElementById('socialMetric').value;
    var date = document.getElementById('socialDate').value;
    var desc = document.getElementById('socialDesc').value;

    if (!title) {
        alert('Please enter a title');
        return;
    }
    if (!date) {
        alert('Please select a date');
        return;
    }

    var params = 'action=add' +
        '&title=' + encodeURIComponent(title) +
        '&type=' + encodeURIComponent(type) +
        '&metric_value=' + encodeURIComponent(metric) +
        '&date=' + encodeURIComponent(date) +
        '&description=' + encodeURIComponent(desc);

    sendAjaxRequest('POST', '../controllers/socialController.php', params, function (response) {
        if (response.success) {
            closeSocialModal();
            document.getElementById('socialTitle').value = '';
            document.getElementById('socialMetric').value = '';
            document.getElementById('socialDesc').value = '';

            loadSocialImpacts();
        } else {
            alert('Failed to add impact');
        }
    });
}

function deleteSocialImpact(id) {
    if (!confirm('Are you sure you want to remove this entry?')) return;

    sendAjaxRequest('POST', '../controllers/socialController.php', 'action=delete&id=' + id, function (response) {
        if (response.success) {
            loadSocialImpacts();
        } else {
            alert('Failed to delete entry');
        }
    });
}


var oldWindowOnClick = window.onclick;
window.onclick = function (event) {
    if (oldWindowOnClick) oldWindowOnClick(event);

    var socialModal = document.getElementById('socialModal');
    if (socialModal && event.target == socialModal) {
        socialModal.style.display = "none";
    }
}



function loadReputationData() {
    if (!document.getElementById('scoreValue')) return;
    sendAjaxRequest('GET', '../controllers/reputationController.php', null, function (data) {
        renderReputation(data);
    });
}

function renderReputation(data) {
    if (data.score_data) {
        var score = parseInt(data.score_data.score);
        var breakdown = JSON.parse(data.score_data.breakdown);

        document.getElementById('scoreValue').innerText = score;

        var circle = document.getElementById('scoreCircle');
        circle.style.background = 'conic-gradient(#5b4df5 ' + score + '%, #e1e1e1 ' + score + '%)';


        updateBar('profileBar', 'profileScore', breakdown.profile, 30);
        updateBar('activityBar', 'activityScore', breakdown.activity, 40);
        updateBar('feedbackBar', 'feedbackScore', breakdown.feedback, 30);
    }


    if (data.feedbacks) {
        var fbContainer = document.getElementById('feedbackList');
        var html = '';
        if (data.feedbacks.length === 0) {
            html = '<p style="color:#999;font-size:14px;">No feedback received yet.</p>';
        } else {
            for (var i = 0; i < data.feedbacks.length; i++) {
                var fb = data.feedbacks[i];
                html += '<div class="feedback-card">';
                html += '<div class="feedback-header">';
                html += '<span class="provider-name">' + fb.provider_name + '</span>';
                html += '<span class="star-rating">' + '★'.repeat(fb.rating) + '☆'.repeat(5 - fb.rating) + '</span>';
                html += '</div>';
                if (fb.comment) {
                    html += '<div style="font-size:14px; color:#555;">' + fb.comment + '</div>';
                }
                html += '</div>';
            }
        }
        fbContainer.innerHTML = html;
    }
}

function updateBar(barId, labelId, value, max) {
    var bar = document.getElementById(barId);
    var label = document.getElementById(labelId);

    var percent = (value / max) * 100;
    if (percent > 100) percent = 100;

    bar.style.width = percent + '%';
    label.innerText = value + ' / ' + max;
}

function calculateReputation() {
    sendAjaxRequest('POST', '../controllers/reputationController.php', 'action=calculate', function (response) {
        if (response.success) {
            loadReputationData();
        } else {
            alert('Calculation failed');
        }
    });
}

function openFeedbackModal() {
    document.getElementById('feedbackModal').style.display = 'block';
}

function closeFeedbackModal() {
    document.getElementById('feedbackModal').style.display = 'none';
}

function submitFeedback() {
    var provider = document.getElementById('fbProvider').value;
    var rating = document.getElementById('fbRating').value;
    var comment = document.getElementById('fbComment').value;

    if (!provider) provider = "Anonymous";

    var params = 'action=add_feedback&provider=' + encodeURIComponent(provider) +
        '&rating=' + encodeURIComponent(rating) +
        '&comment=' + encodeURIComponent(comment);

    sendAjaxRequest('POST', '../controllers/reputationController.php', params, function (response) {
        if (response.success) {
            closeFeedbackModal();
            document.getElementById('fbProvider').value = '';
            document.getElementById('fbComment').value = '';

            loadReputationData();
        } else {
            alert('Failed to add feedback');
        }
    });
}


var oldWindowOnClick2 = window.onclick;
window.onclick = function (event) {
    if (oldWindowOnClick2) oldWindowOnClick2(event);

    var fbModal = document.getElementById('feedbackModal');
    if (fbModal && event.target == fbModal) {
        fbModal.style.display = "none";
    }
}


function loadRewards() {
    if (!document.getElementById('totalPoints')) return;
    sendAjaxRequest('GET', '../controllers/rewardController.php', null, function (data) {
        renderRewards(data);
    });
}

function renderRewards(data) {

    document.getElementById('totalPoints').innerText = data.points;


    if (data.next_badge) {
        var needed = data.next_badge.points_required - data.points;
        document.getElementById('nextMilestone').innerText =
            'Next Badge: ' + data.next_badge.name + ' (' + needed + ' pts needed)';
    } else {
        document.getElementById('nextMilestone').innerText = 'All Badges Unlocked!';
    }


    var container = document.getElementById('badgesList');
    var html = '';

    for (var i = 0; i < data.badges.length; i++) {
        var b = data.badges[i];
        var statusClass = b.unlocked ? 'unlocked' : 'locked';
        var statusText = b.unlocked ? 'UNLOCKED' : 'LOCKED';

        html += '<div class="badge-card ' + statusClass + '">';
        html += '<div class="badge-icon">🏆</div>';
        html += '<div class="badge-name">' + b.name + '</div>';
        html += '<div class="badge-desc">' + b.description + '</div>';
        html += '<div class="badge-status">' + statusText + '</div>';
        html += '</div>';
    }
    container.innerHTML = html;
}
