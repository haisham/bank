<?php
/**
 * Class for Account, required property is account number
 * @property string $_accountNumber Bank account number.
 * @property int $_balance Current account balance
 * @property array $_deposits Deposits in bank account
 * @property array $_withdrawals Withdrawals in bank account
 * @method setAccountNumber($_accountNumber) Sets bank account number
 * @method addDeposit($_deposit) Add a new deposit
 * @method addWithdrawels($_withDrawal) Adds a new withdrawal
 * @method getAccountNumber() Returns a account number
 * @method getWithdrawals() Returns withdrawals for specific account
 * @method getDeposits() Returns deposits for specific account
 * @method getBalance() Returns balance for specific account
 * @method setBalance() Sets balance for specific account
 */

class Account
{
    private $_accountNumber;
    private $_balance;
    private $_deposits = array();
    private $_withdrawals = array();

    public function __construct($_accountNumber)
    {
        $this->_accountNumber = $_accountNumber;
    }

    public function setAccountNumber($_accountNumber)
    {
        $this->_accountNumber = $_accountNumber;
    }

    public function addDeposit($_deposit)
    {
        $this->_deposits[] = $_deposit;
    }

    public function addWithdrawels($_withDrawal)
    {
        $this->_withdrawals[] = $_withDrawal;
    }

    public function getAccountNumber()
    {
        return $this->_accountNumber;
    }

    public function getWithdrawals()
    {
        return $this->_withdrawals;
    }

    public function getDeposits()
    {
        return $this->_deposits;
    }

    public function getBalance()
    {
        return $this->_balance;
    }

    public function setBalance()
    {
        $withdrawalsSum = 0;
        $depositsSum = 0;

        foreach ($this->_withdrawals as $withdrawal) {
            $withdrawalsSum += $withdrawal;
        }

        foreach ($this->_deposits as $deposit) {
            $depositsSum += $deposit;
        }

        $this->_balance = $depositsSum - $withdrawalsSum;
    }
}
