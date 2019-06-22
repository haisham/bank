<?php
/**
 * Class for handling bank, required properties are bank name and address
 * @property string $_bankName Name of the bank.
 * @property string $_bankAddress Address of the bank
 * @property array $_bankAccounts Bank accounts as instance of Account
 * @method setBankName($_bankName) Sets the bank name
 * @method setBankAccounts($_bankAccounts) Sets bank accounts
 * @method setAddress($_bankAddress) Sets the bank address
 * @method addBankAccount($_bankAccount) Adds a new bank account, returns true if account is not duplicate else returns false
 * @method getPostalAddressForPrintLabels Returns a formatted postal address
 * @method getBankAccounts() Returns available bank accounts
 * @method doInternalTransaction($accountOne, $accountTwo, $amount) Does an internal transaction if accounts are existing and internal
 * @method checkIfAccountExists($accountToBeChecked) Check if account already exists, if exists then returns true else returns false
 */

class Bank
{
    private $_bankName;
    private $_bankAddress;
    private $_bankAccounts = array();

    public function __construct($_bankName, $_bankAddress)
    {
        $this->_bankName = $_bankName;
        $this->_bankAddress = $_bankAddress;
    }

    public function setBankName($_bankName)
    {
        $this->_bankName = $_bankName;
    }

    public function setBankAccounts($_bankAccounts)
    {
        $this->_bankAccounts = $_bankAccounts;
    }

    public function setAddress($_bankAddress)
    {
        $this->_bankAddress = $_bankAddress;
    }

    public function addBankAccount($_bankAccount)
    {
        if (!$this->checkIfAccountExists($_bankAccount)) {
            $this->_bankAccounts[] = $_bankAccount;
            return true;
        } else {
            return false;
        }
    }

    public function getPostalAddressForPrintLabels()
    {
        return $this->_bankName . "\n" . $this->_bankAddress;
    }

    public function getBankAccounts()
    {
        return $this->_bankAccounts;
    }

    public function doInternalTransaction($accountOne, $accountTwo, $amount)
    {
        $accountOneIsInternal = false;
        $accountTwoIsInternal = false;

        foreach ($this->_bankAccounts as $account) {
            if ($account->getAccountNumber() === $accountOne->getAccountNumber()) {
                $accountOneIsInternal = true;
            }
        }

        foreach ($this->_bankAccounts as $account) {
            if ($account->getAccountNumber() === $accountTwo->getAccountNumber()) {
                $accountTwoIsInternal = true;
            }
        }

        if ($accountOneIsInternal && $accountTwoIsInternal) {
            $accountOne->addWithdrawels($amount);
            $accountTwo->addDeposit($amount);
            return true;
        } else {
            return false;
        }
    }

    private function checkIfAccountExists($accountToBeChecked)
    {
        foreach ($this->_bankAccounts as $account) {
            if ($account->getAccountNumber() === $accountToBeChecked->getAccountNumber()) {
                return true;
            }
        }
        return false;
    }
}
