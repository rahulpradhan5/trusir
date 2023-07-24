  <!-- footer section -->
  <div class="footer_sec">
    <div class="footer_area section">
      <div class="footer_contact_box">
        <h2 class="h2_title centre_title_h2">Have a Requirement? Let's Discuss</h2>
        <br>
        <a href="Contact_us"><button type="button" class="secondary-button">Contact Us</button></a>
      </div>

      <div class="footer_box_area gap50">
        <div class="footer-box p_text flex-colomn gap10">
          <div class="logo">
            <img src="images/logo.png" alt="">
          </div>
          <p>Trusir is a registered and trusted Indian
            company that offers Home to Home tuition
            service. We have a clear vision of helping
            students achieve their academic
            goals through one-to-one teaching.</p>
          <div class="flex align-center gap20">
            <a href=""><img src="images/instagram.svg" alt=""></a>
            <a href=""><img src="images/facebook.svg" alt=""></a>
            <a href=""><img src="images/youtube.svg" alt=""></a>
          </div>
        </div>
        <div class="footer-box">
          <h3>Contact us</h3>
          <div class="margin-t30 flex-colomn gap10">
            <p>L-91, Bangal colony ,main road
              First floar , Bihar - 404456 </p>
            <p>E-mail : trusher@trusher.com</p>
            <p>Phone : +91-75566964894</p>
          </div>

        </div>
        <div class="footer-box">
          <h3>Pages</h3>
          <div class="margin-t30 flex-colomn gap10">
            <a href="StudentRegistration">
              <p>Student register</p>
            </a>
            <a href="teacherRegistration">
              <p>Teacher register</p>
            </a>
            <a href="Contact_us">
              <p>Contact us</p>
            </a>
          </div>

        </div>
        <div class="footer-box">
          <h3>App</h3>
          <div class="margin-t30 flex-colomn gap10">
            <div class="app flex align-center gap10">
              <div class="app-img">
                <img src="images/playstore.svg" alt="">
              </div>
              <a href="">
                <p>Download Now</p>
              </a>
            </div>
            <div class="app flex align-center gap10">
              <div class="app-img">
                <img src="images/apple.svg" alt="">
              </div>
              <a href="">
                <p>Download Now</p>
              </a>
            </div>
          </div>

        </div>
      </div>
      <div class="footer_copyright_area">
        <div class="footer_devider"></div>
        <p class="footer_copyright_text p_text">© Amacle Studio. Proudly Made in India</p>
      </div>
    </div>
  </div>
  <div class="capta" id="capta"></div>

  <!-- scripts code bootstrap -->
  <!-- scripts -->
  <script src="js/main.js"></script>
  <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
  <script>
    <?php
    if (Session()->has('path') && (Session()->get('path') == "studnetEnq" || Session()->get('path') == "teacherEnq")) {
    ?>
      popupopen('<?php echo Session()->get('path'); ?>');
    <?php
     Session()->forget('path');
    }
    ?>
    
    const firebaseConfig = {
      apiKey: "AIzaSyATd-k8twlwiiwvYqkB9myktplGC0FNHu8",
      authDomain: "trusher-55b57.firebaseapp.com",
      projectId: "trusher-55b57",
      storageBucket: "trusher-55b57.appspot.com",
      messagingSenderId: "755084935582",
      appId: "1:755084935582:web:178a1f6190ba9be498d68f",
      measurementId: "G-MZ0CQ41MBY"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    // window.onload = function() {
    //   render();
    // }


    var appVerifier = new firebase.auth.RecaptchaVerifier('capta', {
      'size': 'invisible'
    });

    function sendCode() {
      $("#login-btn").attr("disabled", "disabled");
      $("#loader").removeClass("d-none");
      var number = '+91' + $("#number").val();
      firebase.auth().signInWithPhoneNumber(number, appVerifier).then((confirmationResult) => {
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult.verificationId; // extract verificationId from confirmationResult
        <?php
        if (isset($_GET['path'])) {
        ?>
          location.href = 'otp?number=' + number + '&result=' + coderesult + '&path=<?php echo $_GET['path']; ?>'; // pass verificationId as parameter in URL
        <?php
        } else {
        ?>
          location.href = 'otp?number=' + number + '&result=' + coderesult; // pass verificationId as parameter in URL
        <?php
        }
        ?>
      }).catch((error) => {
        $("#login-btn").removeAttr("disabled", "disabled");
        $("#loader").addClass("d-none");
        alert(error);
      });

    }

    <?php
    if (isset($result)) {
    ?>
      var confirmationResult = '';

      function verifyCode() {
        $("#verify-btn").attr("disabled", "disabled");
        $("#loader").removeClass("d-none");
        const auth = firebase.auth();
        var otp = $("#otp").val();
        var confirmationResult = "{{$result}}";
        const credential = firebase.auth.PhoneAuthProvider.credential(confirmationResult, otp);
        auth.signInWithCredential(credential)
          .then((userCredential) => {
            // User successfully signed in
            const user = userCredential.user;
            console.log('User signed in:', user.uid);
            // Redirect to the home page
            $.ajax({
              url: "{{route('verifYotp')}}",
              data: {
                mobile: "{{$mobile}}",
              },
              type: 'get',
              success: function(data) {
                console.log(data);
                if (data == "success") {
                  <?php if (isset($_GET['path'])) {
                    Session()->put('path', $_GET['path']);
                  ?>
                    location.href = '/';
                  <?php
                  
                  } else if (Session()->has("path")) {

                  ?>

                    location.href = '/<?php echo Session()->get('path'); ?>';
                  <?php
                    Session()->forget('path');
                  } else {
                  ?>
                    location.href = '/';
                  <?php
                  }
                  ?>

                } else {
                  alert(data);
                }
              }
            })
          })
          .catch((error) => {

            alert('Invalid OTP. Please try again.');
            $("#verify-btn").removeAttr("disabled", "disabled");
            $("#loader").addClass("d-none");
          });
      }

    <?php
    }
    ?>
    <?php
    if (isset($mobile)) {
    ?>

      function resendCode() {
        var count = $("#otpCount").val()
        if (count >= '3') {
          alert('Your otp limit exceeded')
        } else {
          var number = "+{{$mobile}}";
          firebase.auth().signInWithPhoneNumber(number, appVerifier).then((confirmationResult) => {
            window.confirmationResult = confirmationResult;
            confirmationResult = confirmationResult.verificationId; // extract verificationId from confirmationResult
            alert('otp sent successfully');
            count = parseInt(count) + 1;
            document.getElementById("otpCount").value = count;
            $("#count").html('(' + (3 - parseInt(count)) + ')');
            $.ajax({
              url: "count",
              data: {
                count: count,
                number: '{{$mobile}}',
              },
              type: 'get',
              success: function(data) {
                console.log(data);
              }
            })
          }).catch((error) => {
            alert(error);
          });
        }
      }
    <?php
    }
    ?>


    function render() {
      window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('capta');
      recaptchaVerifier.render();
    }
  </script>