document.addEventListener("DOMContentLoaded", function () {
    // Get the form element
    const form = document.querySelector("form");
  
    // Get the notification div, we'll create it dynamically
    const notification = document.createElement("div");
    notification.className = "notification";
    notification.style.display = "none"; // Hidden by default
  
    // Append notification to the body or any container
    document.body.appendChild(notification);
  
    // Listen for form submission
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent actual form submission
  
      // Display notification message
      notification.innerText = "Thank you, your details will be confirmed.";
      notification.style.display = "block";
  
      // Optionally, you can hide the message after a few seconds
      setTimeout(() => {
        notification.style.display = "none";
      }, 3000); // Hide after 3 seconds
  
      // Optionally, submit the form programmatically if needed
      // form.submit();
    });
  });
  