# Paiement

This repository corresponds to the donation website.

> [!TIP]
> When we first started coding this site, we didn't know yet if there were going to be payments other than donations.
> It would probably be a good idea now to rename this entire repo (and its subdomain) to `donation`

## Technical

The donations DB schema is the following :

```sql
CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `postal` int(11) NOT NULL,
  `city` varchar(512) NOT NULL,
  `mailingAddress` varchar(512) NOT NULL,
  `addressComplement` varchar(512) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `companyName` varchar(512) NOT NULL,
  `companySIREN` varchar(25) NOT NULL,
  `companySIRET` varchar(25) NOT NULL,
  `companyContactAddress` varchar(512) NOT NULL,
  `companyAddress` varchar(512) NOT NULL,
  `companyAddressComplement` varchar(512) NOT NULL,
  `companyPostal` int(11) NOT NULL,
  `companyCity` varchar(512) NOT NULL,
  `amount_donated` float NOT NULL,
  `real_amount` float NOT NULL,
  `isCompany` tinyint(1) NOT NULL,
  `isAnonymous` tinyint(1) NOT NULL,
  `isCash` tinyint(1) NOT NULL,
  `isCheque` tinyint(1) NOT NULL,
  `isCard` tinyint(1) NOT NULL,
  `isChequeToIT` tinyint(1) NOT NULL,
  `isDonSimple` tinyint(1) NOT NULL,
  `isVente` tinyint(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

COMMIT;
```

Please note the last properties in the database aren't used here (as the payments are always by card), but rather [in the staff's app](https://github.com/ronde-de-l-espoir/app-www/tree/main/money-form).

## Stripe

Since the very beginning, we decided we'd go with [Stripe](https://stripe.com) because the PHP and JS implementation is really quite simple (and we didn't have that much time to spare...).

When you setup Stripe, you need to enter the legal details of your company.
As we do not have legal details as the "Ronde de l'Espoir", you must enter the information the association you are helping sends you.

You will have to ask for the following (in French for direct copy-n-paste in your email...) :
* Le type de société (Association/Société/Micro-entreprise/Auto-entrepreneur)
* Association de fait/déclarée ?
* La dénomination sociale
* SIREN
* Adresse
* Téléphone
* Site web (ou réseaux sociaux)
* Description de l’activité (en 1 ou 2 phrases)
* A propos du représentant légal :
  - Nom et prénom
  - Adresse mail
  - Intitulé du poste (gérant…)
  - Date de naissance
  - Adresse
  - Téléphone personnel
* Numéro IBAN du compte bancaire de l’association recevant les fonds

Stripe proposes a test mode, with test API keys.
On the opening of the donations, make sure to replace the test API keys by the real ones (yes, we practically made that mistake)...

## Possible (and necessary) improvements

Before proceeding to payment, or next to the Stripe Elements box, it would be nice to have a recap of the donation.
The donators would probably feel much more at ease before paying.

Also, you should add help buttons everywhere, because it turned out the website was 2 entire days, and nobody was reporting any issue...

Lastly, to avoid problems with the test and real API keys as discussed above, it would be nice to use the test keys on the `dev.paiement` site and the real ones on `paiement`, although deploying that doesn't seem easy...