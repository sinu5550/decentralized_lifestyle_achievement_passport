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


function updateCV() {
    
    document.getElementById('cvName').textContent = document.getElementById('inpName').value || 'Your Name';
    document.getElementById('cvTitle').textContent = document.getElementById('inpTitle').value || 'Job Title';
    document.getElementById('cvEmail').textContent = document.getElementById('inpEmail').value || 'email@example.com';
    document.getElementById('cvPhone').textContent = document.getElementById('inpPhone').value || 'Phone';
    document.getElementById('cvSummary').textContent = document.getElementById('inpSummary').value || 'Summary...';

    // Experience
    const expContainer = document.getElementById('cvExperience');
    expContainer.innerHTML = '';
    const roles = document.querySelectorAll('.exp-role');
    const companies = document.querySelectorAll('.exp-company');
    const descs = document.querySelectorAll('.exp-desc');

    for (let i = 0; i < roles.length; i++) {
        if (roles[i].value || companies[i].value) {
            const div = document.createElement('div');
            div.className = 'cv-item';
            div.innerHTML = `
                <div class="cv-item-title">${roles[i].value}</div>
                <div class="cv-item-subtitle">${companies[i].value}</div>
                <p>${descs[i].value}</p>
            `;
            expContainer.appendChild(div);
        }
    }


    const eduContainer = document.getElementById('cvEducation');
    eduContainer.innerHTML = '';
    const degrees = document.querySelectorAll('.edu-degree');
    const schools = document.querySelectorAll('.edu-school');

    for (let i = 0; i < degrees.length; i++) {
        if (degrees[i].value || schools[i].value) {
            const div = document.createElement('div');
            div.className = 'cv-item';
            div.innerHTML = `
                <div class="cv-item-title">${degrees[i].value}</div>
                <div class="cv-item-subtitle">${schools[i].value}</div>
            `;
            eduContainer.appendChild(div);
        }
    }


    const skillsContainer = document.getElementById('cvSkills');
    skillsContainer.innerHTML = '';
    const skillsText = document.getElementById('inpSkills').value;
    if (skillsText) {
        const skills = skillsText.split(',');
        skills.forEach(skill => {
            if (skill.trim()) {
                const s = document.createElement('span');
                s.className = 'cv-skill-tag';
                s.textContent = skill.trim();
                skillsContainer.appendChild(s);
            }
        });
    }
}

function addExperienceField() {
    const container = document.getElementById('exp-container');
    const div = document.createElement('div');
    div.className = 'form-group';
    div.style.borderTop = '1px solid #eee';
    div.style.marginTop = '10px';
    div.style.paddingTop = '10px';
    div.innerHTML = `
        <input type="text" class="exp-role" placeholder="Role" style="margin-bottom:5px;">
        <input type="text" class="exp-company" placeholder="Company" style="margin-bottom:5px;">
        <textarea class="exp-desc" placeholder="Responsibilities..." style="height:60px;"></textarea>
    `;
    container.appendChild(div);
}

function addEducationField() {
    const container = document.getElementById('edu-container');
    const div = document.createElement('div');
    div.className = 'form-group';
    div.style.borderTop = '1px solid #eee';
    div.style.marginTop = '10px';
    div.style.paddingTop = '10px';
    div.innerHTML = `
        <input type="text" class="edu-degree" placeholder="Degree" style="margin-bottom:5px;">
        <input type="text" class="edu-school" placeholder="School / University">
    `;
    container.appendChild(div);
}