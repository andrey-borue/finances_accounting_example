<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Currency;
use App\Entity\CurrencyRate;
use App\Entity\Transaction;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    protected static $currencyCode = [
        'AED', 'AFN', 'ALL', 'AMD', 'ANG', 'AOA', 'ARS', 'AUD', 'AWG', 'AZN',
        'BAM', 'BBD', 'BDT', 'BGN', 'BHD', 'BIF', 'BMD', 'BND', 'BOB', 'BRL',
        'BSD', 'BTN', 'BWP', 'BYN', 'BZD', 'CAD', 'CDF', 'CHF', 'CLP', 'CNY',
        'COP', 'CRC', 'CUC', 'CUP', 'CVE', 'CZK', 'DJF', 'DKK', 'DOP', 'DZD',
        'EGP', 'ERN', 'ETB', 'EUR', 'FJD', 'FKP', 'GBP', 'GEL', 'GHS', 'GIP',
        'GMD', 'GNF', 'GTQ', 'GYD', 'HKD', 'HNL', 'HRK', 'HTG', 'HUF', 'IDR',
        'ILS', 'INR', 'IQD', 'IRR', 'ISK', 'JMD', 'JOD', 'JPY', 'KES', 'KGS',
        'KHR', 'KMF', 'KPW', 'KRW', 'KWD', 'KYD', 'KZT', 'LAK', 'LBP', 'LKR',
        'LRD', 'LSL', 'LYD', 'MAD', 'MDL', 'MGA', 'MKD', 'MMK', 'MNT', 'MOP',
        'MRO', 'MUR', 'MVR', 'MWK', 'MXN', 'MYR', 'MZN', 'NAD', 'NGN', 'NIO',
        'NOK', 'NPR', 'NZD', 'OMR', 'PAB', 'PEN', 'PGK', 'PHP', 'PKR', 'PLN',
        'PYG', 'QAR', 'RON', 'RSD', 'RUB', 'RWF', 'SAR', 'SBD', 'SCR', 'SDG',
        'SEK', 'SGD', 'SHP', 'SLL', 'SOS', 'SRD', 'SSP', 'STD', 'SVC', 'SYP',
        'SZL', 'THB', 'TJS', 'TMT', 'TND', 'TOP', 'TRY', 'TTD', 'TWD', 'TZS',
        'UAH', 'UGX', 'USD', 'UYU', 'UZS', 'VEF', 'VND', 'VUV', 'WST', 'XAF',
        'XCD', 'XOF', 'XPF', 'YER', 'ZAR', 'ZMW', 'ZWL',
    ];

    protected static $rates = ['AED' => 3.672704, 'AFN' => 70.150002, 'ALL' => 105.800003, 'AMD' => 482.820007, 'ANG' => 1.780403, 'AOA' => 224.682999, 'ARS' => 20.513041, 'AUD' => 1.318704, 'AWG' => 1.78, 'AZN' => 1.699504, 'BAM' => 1.614904, 'BBD' => 2, 'BDT' => 82.870003, 'BGN' => 1.620404, 'BHD' => 0.376804, 'BIF' => 1750.97998, 'BMD' => 1, 'BND' => 1.291804, 'BOB' => 6.860399, 'BRL' => 3.456204, 'BSD' => 1, 'BTC' => 0.000108, 'BTN' => 66.800003, 'BWP' => 9.818204, 'BYN' => 2.000363, 'BYR' => 19600, 'BZD' => 1.997804, 'CAD' => 1.282104, 'CDF' => 1565.50392, 'CHF' => 0.987304, 'CLF' => 0.022204, 'CLP' => 606.000361, 'CNY' => 6.332404, 'COP' => 2804.199951, 'CRC' => 561.190002, 'CUC' => 1, 'CUP' => 26.5, 'CVE' => 90.910004, 'CZK' => 20.974001, 'DJF' => 176.830002, 'DKK' => 6.140904, 'DOP' => 49.389999, 'DZD' => 114.773003, 'EGP' => 17.660393, 'ERN' => 15.270392, 'ETB' => 27.200001, 'EUR' => 0.824304, 'FJD' => 2.04504, 'FKP' => 0.725104, 'GBP' => 0.72584, 'GEL' => 2.45404, 'GGP' => 0.725956, 'GHS' => 4.478504, 'GIP' => 0.725304, 'GMD' => 46.830002, 'GNF' => 8997.000355, 'GTQ' => 7.33604, 'GYD' => 206.639999, 'HKD' => 7.84604, 'HNL' => 23.59404, 'HRK' => 6.134504, 'HTG' => 63.860001, 'HUF' => 257.619995, 'IDR' => 13883, 'ILS' => 3.58404, 'IMP' => 0.725956, 'INR' => 66.589996, 'IQD' => 1184, 'IRR' => 42000.000352, 'ISK' => 100.900002, 'JEP' => 0.725956, 'JMD' => 123.730003, 'JOD' => 0.708504, 'JPY' => 109.032997, 'KES' => 100.150002, 'KGS' => 68.782604, 'KHR' => 4018.000351, 'KMF' => 406.399994, 'KPW' => 900.00035, 'KRW' => 1066.22998, 'KWD' => 0.30095, 'KYD' => 0.820383, 'KZT' => 327.350006, 'LAK' => 8297.000349, 'LBP' => 1505.699951, 'LKR' => 157.399994, 'LRD' => 131.240005, 'LSL' => 12.320382, 'LTL' => 3.048704, 'LVL' => 0.62055, 'LYD' => 1.335804, 'MAD' => 9.264804, 'MDL' => 16.504999, 'MGA' => 3200.000347, 'MKD' => 50.470001, 'MMK' => 1324.000346, 'MNT' => 2392.000346, 'MOP' => 8.081404, 'MRO' => 353.000346, 'MUR' => 34.000346, 'MVR' => 15.570378, 'MWK' => 713.450012, 'MXN' => 18.608039, 'MYR' => 3.917039, 'MZN' => 59.090377, 'NAD' => 12.314039, 'NGN' => 359.000344, 'NIO' => 31.030001, 'NOK' => 7.958704, 'NPR' => 106.449997, 'NZD' => 1.411504, 'OMR' => 0.384804, 'PAB' => 1, 'PEN' => 3.231404, 'PGK' => 3.249504, 'PHP' => 51.619999, 'PKR' => 115.503704, 'PLN' => 3.468504, 'PYG' => 5538.000341, 'QAR' => 3.641304, 'RON' => 3.842604, 'RSD' => 97.305199, 'RUB' => 61.960098, 'RWF' => 846.409973, 'SAR' => 3.749804, 'SBD' => 7.779604, 'SCR' => 13.376038, 'SDG' => 18.050204, 'SEK' => 8.657104, 'SGD' => 1.322704, 'SHP' => 0.725304, 'SLL' => 7800.000339, 'SOS' => 562.000338, 'SRD' => 7.403664, 'STD' => 20201.099609, 'SVC' => 8.75037, 'SYP' => 514.97998, 'SZL' => 12.322038, 'THB' => 31.503653, 'TJS' => 8.895504, 'TMT' => 3.4, 'TND' => 2.442038, 'TOP' => 2.212304, 'TRY' => 4.041204, 'TTD' => 6.750368, 'TWD' => 29.561001, 'TZS' => 2276.000336, 'UAH' => 26.209999, 'UGX' => 3699.000335, '' => 1, 'UYU' => 28.389999, 'UZS' => 8051.000335, 'VEF' => 66770.000334, 'VND' => 22762, 'VUV' => 108.430366, 'WST' => 2.562904, 'XAF' => 540.380005, 'XAG' => 0.060509, 'XAU' => 0.000756, 'XCD' => 2.703606, 'XDR' => 0.695509, 'XOF' => 540.380005, 'XPF' => 98.381573, 'YER' => 249.899994, 'ZAR' => 12.321504, 'ZMK' => 9001.203593, 'ZMW' => 9.730363, 'ZWL' => 322.355011];



    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = \Faker\Factory::create();

        $currencies = [];
        $rates = [];


        foreach (self::$currencyCode as $item) {
            if (!isset(self::$rates[$item])) {
                continue;
            }

            $currency = new Currency();
            $currency->setCode($item);

            $rate = new CurrencyRate();
            $rate->setCurrency($currency)->setRate(self::$rates[$item]);

            $currencies[] = $currency;
            $rates[$currency->getCode()] = self::$rates[$item];

            $manager->persist($rate);
            $manager->persist($currency);
        }

        /** @var Account[] $accounts */
        $accounts = [];

        for ($i = 0; $i < 100; $i++) {
            $user = new User();

            $user
                ->setName($faker->name)
                ->setCity($faker->city)
                ->setCountry($faker->country);

            $manager->persist($user);

            $account = new Account();
            $account
                ->setUser($user)
                ->setCurrency($faker->randomElement($currencies))
                ->setTotal('0');

            $accounts[] = $account;

            $manager->persist($account);

            for ($j = 1; $j <= 2; $j++) {
                $transaction = new Transaction();
                $transaction
                    ->setAccount($account)
                    ->setIncome((string)$faker->randomFloat(2, 1000, 2000));

                $transaction->setIncomeOrigin(
                    bcdiv($transaction->getIncome(), $rates[$account->getCurrency()->getCode()], 2)
                );

                $transaction->setAccount($account);
                $account->setTotal(bcadd($account->getTotal(), $transaction->getIncome(), 2));

                $manager->persist($transaction);
            }
        }

//        $manager->flush();

        $transactions = [];
        // Fake transitions
        foreach ($accounts as $account) {
            /** @var Account[] $externalAccounts */
            $externalAccounts = $faker->randomElements($accounts, 10);
            foreach ($externalAccounts as $externalAccount) {

                if ($externalAccount === $account) {
                    continue;
                }
                $outcome = $faker->randomFloat(2, 40, 100);
                $outcomeOrigin = bcdiv($outcome, $rates[$account->getCurrency()->getCode()], 2);

                $income = bcmul($outcomeOrigin, $rates[$externalAccount->getCurrency()->getCode()], 2);

                $transaction = new Transaction();
                $transaction
                    ->setAccount($account)
                    ->setExternalAccount($externalAccount)
                    ->setOutcome($outcome)
                    ->setOutcomeOrigin($outcomeOrigin);

                $account->setTotal(bcsub($account->getTotal(), $outcome, 2));

                $relatedTransaction = new Transaction();
                $relatedTransaction
                    ->setAccount($externalAccount)
                    ->setExternalAccount($account)
                    ->setIncome($income)
                    ->setIncomeOrigin($outcomeOrigin);

                $externalAccount->setTotal(bcadd($externalAccount->getTotal(), $income, 2));

                $manager->persist($relatedTransaction);
                $manager->persist($transaction);

                $transactions[] = $relatedTransaction;
                $transactions[] = $transaction;
            }
        }

        $manager->flush();
    }
}
