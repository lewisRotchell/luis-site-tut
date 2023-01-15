document.addEventListener("DOMContentLoaded", function () {
  const openModalBtn = document.querySelectorAll(".open-modal");
  const modalEl = document.querySelector(".wp-block-udemy-plus-auth-modal");

  const modalCloseEl = document.querySelectorAll(
    ".modal-overlay, .modal-btn-close"
  );
  modalCloseEl.forEach((el) => {
    el.addEventListener("click", (e) => {
      e.preventDefault();
      modalEl.classList.remove("modal-show");
    });
  });

  openModalBtn.forEach((el) => {
    el.addEventListener("click", (e) => {
      e.preventDefault();
      modalEl.classList.add("modal-show");
    });
  });

  const tabs = document.querySelectorAll(".tabs a");
  const signInForm = document.querySelector("#signin-tab");
  const signUpForm = document.querySelector("#signup-tab");

  tabs.forEach((tab) => {
    tab.addEventListener("click", (e) => {
      e.preventDefault();
      tabs.forEach((currentTab) => {
        currentTab.classList.remove("active-tab");
      });
      e.currentTarget.classList.add("active-tab");

      const activeTab = e.currentTarget.getAttribute("href");

      if (activeTab === "#signin-tab") {
        signInForm.style.display = "block";
        signUpForm.style.display = "none";
      } else {
        signInForm.style.display = "none";
        signUpForm.style.display = "block";
      }
    });
  });

  if (signUpForm) {
    signUpForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      const signupFieldSet = signUpForm.querySelector("fieldset");
      signupFieldSet.setAttribute("disabled", true);

      const signupStatus = signUpForm.querySelector("#signup-status");

      signupStatus.innerHTML = `
      <div class="modal-status modal-status-info">
      Please Wait! We are creating your account.
      </div>
      `;

      const formData = {
        username: signUpForm.querySelector("#su-name").value,
        email: signUpForm.querySelector("#su-email").value,
        password: signUpForm.querySelector("#su-password").value,
      };

      const response = await fetch(up_auth_rest.signup, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });
      const responseJson = await response.json();

      if (responseJson.status === 2) {
        signupStatus.innerHTML = `
        <div class="modal-status modal-status-success">
        Success! Your account has been created.
        </div>
        `;
        location.reload();
      } else {
        signupFieldSet.removeAttribute("disabled");
        signupStatus.innerHTML = `
        <div class="modal-status modal-status-danger">
        Unable to create account. Please try again.
        </div>
        `;
      }
    });
  }

  if (signInForm) {
    signInForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      const signinFieldSet = signInForm.querySelector("fieldset");
      signinFieldSet.setAttribute("disabled", true);

      const signinStatus = signInForm.querySelector("#signin-status");
      signinStatus.innerHTML = `
    <div class="modal-status modal-status-info">
    Please Wait! We are logging you in.
    </div>
    `;
      const formData = {
        user_login: signInForm.querySelector("#si-email").value,
        password: signInForm.querySelector("#si-password").value,
      };

      const response = await fetch(up_auth_rest.signin, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });
      const responseJson = await response.json();

      if (responseJson.status === 2) {
        signinStatus.innerHTML = `
      <div class="modal-status modal-status-success">
      Success! You are logged in.
      </div>
      `;
        location.reload();
      } else {
        signinFieldSet.removeAttribute("disabled");
        signinStatus.innerHTML = `
      <div class="modal-status modal-status-danger">
      Unable to login. Please try again.
      </div>
      `;
      }
    });
  }
});
