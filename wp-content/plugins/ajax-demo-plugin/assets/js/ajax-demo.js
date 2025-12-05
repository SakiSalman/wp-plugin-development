document.addEventListener("DOMContentLoaded", function () {
  console.log("AJAX Demo JS loaded");
  const button = document.getElementById("ajax-demo-button");
  const dailyRatesButton = document.getElementById("daily-rates-button");
  if (button) {
    button.addEventListener("click", async function () {
      console.log("AJAX button clicked!", admp_ajax_object.ajax_url);
      const formData = new FormData();
      formData.append("action", "demo_button");
      const response = await fetch(admp_ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });
      const json = await response.json();
      console.log("Response from server:", json);
    });
  }

  if (dailyRatesButton) {
    const resultDiv = document.getElementById("daily-rates-result");
    dailyRatesButton.addEventListener("click", async function () {
      console.log("Daily Rates button clicked!", admp_ajax_object.ajax_url);
      resultDiv.innerHTML = "Loading...";
      const formData = new FormData();
      formData.append("action", "fetch_daily_rates");
      const response = await fetch(admp_ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });
      const jsonData = await response.json();

      if (jsonData.success) {
        const rates = jsonData.data;
        document.getElementById("daily-rates-result").innerHTML = `
                    <h3>Daily Rates:</h3>
                    <ul>
                       ${Object.keys(rates)
                         .map(
                           (currency) =>
                             `<li>${currency}: ${rates[currency]}</li>`
                         )
                         .join("")}
                    </ul>
                `;
      }
    });
  }

  const contactForm = document.getElementById("admp-contact-form");
  if (contactForm) {
    contactForm.addEventListener("submit", async function (e) {
      console.log("event", e);
      e.preventDefault();
      const formData = new FormData(this);
      formData.append("action", "admp_submit_contact_form");
      formData.append(
        "nonce",
        admp_ajax_object.contact_nonce
      );
      const response = await fetch(admp_ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });
      const resultDiv = document.getElementById("ajax-demo-contact-result");
      const data = await response.json();
        console.log("Contact form response:", data);
      if (data.success) {
        resultDiv.innerHTML = "<p>" + data.data + "</p>";
        this.reset();
      } else {
        resultDiv.innerHTML = "<p>" + data.data + "</p>";
      }
    });
  }
});
