function confirmDelete(message = 'Are you sure?') {
    return confirm(message);
}



async function handleAjaxAction(event, url, callback) {
    event.preventDefault();
    try {
        const response = await fetch(url + '&ajax=true');
        const data = await response.json();
        if (data.success) {
            callback(data);
        } else {
            alert(data.error || 'Action failed');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Network error');
    }
}


function markNotificationRead(event, element) {
    event.preventDefault();
    const url = element.href;

    handleAjaxAction(event, url, (data) => {

        const card = element.closest('.notif-card');
        card.classList.remove('unread');
        element.remove(); // Remove the blue dot

        // Update menu badge
        const badge = document.querySelector('.menu-badge');
        if (badge) {
            badge.textContent = data.unreadCount;
            if (data.unreadCount == 0) badge.remove();
        }
    });
}

// Milestone 
function toggleMilestone(event, id) {
    event.preventDefault();


    const url = `../controllers/goalController.php?toggle_milestone=${id}`;

    handleAjaxAction(event, url, (data) => {

        const item = document.getElementById(`milestone-${id}`);

        const iconContainer = item.querySelector('.ms-icon');
        const isDone = item.classList.contains('done');

        if (isDone) {
            item.classList.remove('done');
            iconContainer.innerHTML = '<span style="display:inline-block; width:14px; height:14px; border:1px solid #777; border-radius:3px;"></span>';
        } else {
            item.classList.add('done');
            iconContainer.innerHTML = '<img src="../assets/menuImages/checkmark.png" width="16" alt="Done">';
        }
    });
}


function handleChallengeAction(event, url, type) {
    event.preventDefault();

    handleAjaxAction(event, url, (data) => {
        if (type == 'join') alert('Challenge joined!');
        if (type == 'complete') alert('Challenge completed!');
        setTimeout(() => location.reload(), 500);
    });
}


function validateGoalForm(event) {
    const deadlineInput = document.querySelector('input[name="deadline"]');
    if (deadlineInput) {
        const selectedDate = new Date(deadlineInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            event.preventDefault();
            alert('Deadline cannot be in the past!');
            return false;
        }
    }
    return true;

}