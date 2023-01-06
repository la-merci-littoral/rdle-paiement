const stripe = Stripe("pk_test_51MKmfEHCHeIMvgvqmuHVGLTmz16ZSgGZqVTqkZFVFULWIZfAUGQYth8V8ndOaB1YnFMfj3NUKFzsT34OCgRssfdU0009jFo3Ns");

let elements;


initialize();
checkStatus();

document
    .querySelector("#payment-form")
    .addEventListener("submit", handleSubmit);


var emailAddress = '';
// Fetches a payment intent and captures the client secret
async function initialize() {
    const { clientSecret } = await fetch("./paiement-process.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        // body: JSON.stringify({ items }),
    }).then((r) => r.json());

    console.log("Initializing...");
  
    elements = stripe.elements({ clientSecret });
  
    const linkAuthenticationElement = elements.create("linkAuthentication");
    linkAuthenticationElement.mount("#link-authentication-element");
  
    const paymentElementOptions = {
        layout: "tabs",
    };
  
    const paymentElement = elements.create("payment", paymentElementOptions);
    paymentElement.mount("#payment-element");
    console.log("Did it though ?");
}

async function handleSubmit(e) {
    e.preventDefault();
    setLoading(true);

    
    const { error } = await stripe.confirmPayment({
        elements,
        confirmParams: {
        // Make sure to change this to your payment completion page
        return_url: "https://ronde-de-l-espoir.fr/main",
        receipt_email: emailAddress,
        },
    });

    if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message);
    } else {
        showMessage("An unexpected error occurred.");
    }

    setLoading(false);
}

// Fetches the payment intent status after payment submission
async function checkStatus() {
    const clientSecret = new URLSearchParams(window.location.search).get(
    "payment_intent_client_secret"
    );

    if (!clientSecret) {
        return;
    }

    const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

    switch (paymentIntent.status) {
        case "succeeded":
            showMessage("Payment succeeded!");
            break;
        case "processing":
            showMessage("Your payment is processing.");
            break;
        case "requires_payment_method":
            showMessage("Your payment was not successful, please try again.");
            break;
        default:
            showMessage("Something went wrong.");
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