# Paiement

Welcome to paiement ! 
This is the repo where the donation website is coded.

The DB schema is the following :

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