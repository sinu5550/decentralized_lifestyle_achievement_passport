<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/menuStyle.css" />
</head>

<body>
    <div class="flex">
        <div class="menubar">
            <?php require_once "menubar.php"; ?>
        </div>
        <div class="container">
            <div>
                <h3>Help & Support Center</h3>
                <p>Find answers and get help with your account</p>
                <div class="support-card">
                    <div class="tabs">
                        <button class="active">FAQ</button>
                        <button>Submit issue</button>
                        <button>My Tickets(0)</button>
                    </div>
                </div>
                <div class="support-card">
                    <div class="faq">
                        <h4><span class="ques-icon">?</span>Frequently Asked Questions</h4>

                        <details class="faq-item">
                            <summary>How do I earn points?</summary>
                            <p>You earn points by completing goals, challenges, and participating in community activities.</p>
                        </details>

                        <details class="faq-item">
                            <summary>What are badges and how do I unlock them?</summary>
                            <p>Badges are achievements awarded for milestones such as consistency, leadership, and impact.</p>
                        </details>

                        <details class="faq-item">
                            <summary>How does the reputation score work?</summary>
                            <p>Your reputation score is calculated based on points earned, endorsements, and activity level.</p>
                        </details>

                        <details class="faq-item">
                            <summary>Can I reset my password?</summary>
                            <p>Yes. Go to your profile settings and choose "Reset Password".</p>
                        </details>

                        <details class="faq-item">
                            <summary>Can I download my CV?</summary>
                            <p>Yes, you can download your CV from the CV Generator section.</p>
                        </details>
                    </div>


                </div>
                <div class="support-card">
                    <div class="rating">
                        <h4>Rate Platform Features</h4>

                        <select>
                            <option>Select a feature</option>
                            <option>Dashboard</option>
                            <option>CV Generator</option>
                            <option>Community</option>
                        </select>

                        <div class="stars">
                            <div class="star">1</div>
                            <div class="star">2</div>
                            <div class="star">3</div>
                            <div class="star">4</div>
                            <div class="star">5</div>
                        </div>

                        <textarea rows="3" placeholder="Share your thoughts..."></textarea>

                        <button class="button-blue" style="margin-top: 10px;">Submit Feedback</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>