# 'Paiement' subdomain


This repositary contains the code that is responsible for handling payments and saving the donator's information in our database.

The documentation of this repo is going to follow a mostly linear path, meaning we will start with the first page a random user would arrive on, and check how everything works, then we will follow with the second page, etc, etc...

Summary:
- [General Informations](#general-informations)
- [Landing page](#landing-page)
- Path for **Individuals**:
 - 
- Path for **Anonymous**:
 - 
- Path for **Companies**:
 - 



## General Informations
To handle payment, we have decided to use [Stripe](https://stripe.com/en-fr). Stripe is similar to Paypal for example, but takes a lower fee than Payal does.

### Fees
Stripe takes a 1.5% fee on every transaction done with a credit card, plus 25 cents.
However, it is important to note that transactions made with a company credit card will have a fee of 1.9% in addition to the 25 cents.


## Landing Page
