const stripe = Stripe("pk_live_51MKmfEHCHeIMvgvqEm06zmt6Yk5xziwdTlpgv1FbY3nPI5MMTb9Z44x1cePVRBGazIAUsPV8PF4BlGapU7aFYAbt00QElG6oWE");

let elements;

initialize(); // Call the initialize function to set up the payment form
checkStatus(); // Call the checkStatus function to check the payment intent status

document
    .querySelector("#payment-form")
    .addEventListener("submit", handleSubmit); // Add an event listener to the payment form submit button, calling the handleSubmit function

// Fetches a payment intent and captures the client secret
async function initialize() {
    const { clientSecret } = await fetch("paiement-process.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        // body: JSON.stringify({ items }),
    }).then((r) => r.json()); // Fetch the client secret from the server

    elements = stripe.elements({ clientSecret }); // Create Stripe elements using the client secret

    const linkAuthenticationElement = elements.create("linkAuthentication");
    linkAuthenticationElement.mount("#link-authentication-element"); // Mount the linkAuthentication element to the specified DOM element

    const paymentElementOptions = {
        layout: "tabs",
    };

    const paymentElement = elements.create("payment", paymentElementOptions);
    paymentElement.mount("#payment-element"); // Mount the payment element to the specified DOM element
}

async function handleSubmit(e) {
    e.preventDefault();
    setLoading(true); // Set loading state to true

    $localUrl = "https://localhost/paiement/validation/index.php";
    $realUrl = "https://paiement.ronde-de-l-espoir.fr/validation/index.php";

    const { error } = await stripe.confirmPayment({
        elements,
        confirmParams: {
            // Make sure to change this to your payment completion page
            return_url: $realUrl
        },
    }); // Confirm the payment with Stripe

    if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message); // Show error message if there is a card or validation error
    } else {
        showMessage("An unexpected error occurred."); // Show a generic error message
    }

    setLoading(false); // Set loading state to false
}

// Fetches the payment intent status after payment submission
async function checkStatus() {
    const clientSecret = new URLSearchParams(window.location.search).get(
        "payment_intent_client_secret"
    ); // Get the client secret from the URL query parameter

    if (!clientSecret) {
        return;
    }

    const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret); // Retrieve the payment intent from Stripe

    switch (paymentIntent.status) {
        case "succeeded":
            showMessage("Payment succeeded!"); // Show success message if payment is succeeded
            break;
        case "processing":
            showMessage("Your payment is processing."); // Show processing message if payment is still processing
            break;
        case "requires_payment_method":
            showMessage("Your payment was not successful, please try again."); // Show error message if payment requires a new payment method
            break;
        default:
            showMessage("Something went wrong."); // Show generic error message
            break;
    }
}

function showMessage(messageText) {
    const messageContainer = document.querySelector("#payment-message");

    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;

    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 4000);
}

// Show a spinner on payment submission
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        document.querySelector("#submit").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");
    } else {
        document.querySelector("#submit").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
    }
}
