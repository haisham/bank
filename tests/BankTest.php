<?php

use PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{
    public function setUp()
    {
        $this->firstAccountNumber = 'ab01';
        $this->secondAccountNumber = 'qj42';
        $this->duplicateAccountNumber = 'ab01';
        $this->bankName = "JOE & THE BANK";
        $this->bankAddress = "Joe Street,\\nCopenhagen";
    }

    public function testValidPostalAddressCanBeCreated(): void
    {
        $expectedPostalAddress = $this->bankName . "\n" . $this->bankAddress;
        $bank = new Bank($this->bankName, $this->bankAddress);
        $this->assertEquals($expectedPostalAddress, $bank->getPostalAddressForPrintLabels());
    }

    public function testCreateBankAccounts(): void
    {
        $firstAccount = new Account($this->firstAccountNumber);
        $bank = new Bank($this->bankName, $this->bankAddress);
        $bank->addBankAccount($firstAccount);

        $secondAccount = new Account($this->secondAccountNumber);
        $bank->addBankAccount($secondAccount);

        $this->assertEquals(2, count($bank->getBankAccounts()));
    }

    public function testAvoidDuplicateAccounts(): void
    {
        $firstAccount = new Account($this->firstAccountNumber);
        $bank = new Bank($this->bankName, $this->bankAddress);
        $this->assertTrue($bank->addBankAccount($firstAccount));
        $this->assertEquals(1, count($bank->getBankAccounts()));

        $duplicateAccount = new Account($this->duplicateAccountNumber);
        $this->assertFalse($bank->addBankAccount($duplicateAccount));
    }

    public function testDoInternalTransactions(): void
    {
        $bank = new Bank($this->bankName, $this->bankAddress);

        $firstAccount = new Account($this->firstAccountNumber);
        $bank->addBankAccount($firstAccount);

        $secondAccount = new Account($this->secondAccountNumber);
        $bank->addBankAccount($secondAccount);

        $bank->doInternalTransaction($firstAccount, $secondAccount, 100);
        $this->assertEquals(1, count($firstAccount->getWithdrawals()));
        $this->assertEquals(1, count($secondAccount->getDeposits()));
    }

}
