</div>
                        
    </section>

    </main>
    <footer class="footer">
        <section class="flex-grid">
            <div class="half col">
                <p>We want to help you save money year-round, not just during tax season.</p>
                <a class="qbseLink" href="http://fbuy.me" target="_blank"><img class="qbseImg" src="../images/logo_qbo.svg" height="36" alt="Quickbooks Self-Employed" /> <span class="qbse">Click here to save 50%</span></a>
            </div>
            <div class="half col">
                <p>Office: <a href="tel:1-888-555-1212">(888) 555-1212</a> | Fax: (888) 555-1313</p>
                <p><a href="mailto:hello@company.co">hello@company.co</a></p>
                <p><a href="../start.html">In-Person By Appointment Only</a></p>
                <p>
                    <a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    <a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </p>
            </div>
        </section>
    </footer>
        <div class="copyright"></div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="../jquery-ui/external/jquery/jquery.js"></script>
        <script src="../jquery-ui/jquery-ui.js"></script>
        <!-- <script src="../scripts.js"></script> -->
        
        <script>
            $(".top-nav").on('click', '#mobile-menu', function(e) {
                // e.preventDefault();
                $(".mobile-menu-list").fadeToggle("slow");
            });
            function getThisYear(){
                const today = new Date();
                const thisYear = today.getFullYear();
                const copyright = `Copyright ${thisYear} All rights reserved.`;
                $('.copyright').html(copyright);  
            }
            getThisYear();
            $('#accordion').accordion({ collapsible: true, heightStyle: 'content' });

            // Confirm Password Match on Create Profile page
            var password = document.getElementById('password')
            , confirmPassword = document.getElementById('confirmPassword');

            function validatePassword(){
            if(password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity("Passwords Don't Match");
            } else {
            confirmPassword.setCustomValidity('');
            }
            }

            if(password){
                password.onchange = validatePassword;
            }

            if(confirmPassword){
                confirmPassword.onkeyup = validatePassword;
            }

        </script>
        
</body>
</html>