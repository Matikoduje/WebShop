<?php

class InvoiceRepository
{
    public static function prepareConnection()
    {
        $conn = new Connection();
        $conn = $conn->doConnect();
        return $conn;
    }

    public function save(Invoice $invoice)
    {
        $conn = $this->prepareConnection();

        if ($invoice->getId() == -1) {
            try {
                $preparedStatement = $conn->prepare("INSERT INTO `invoices` (`isInvoiceIssued`,
                `isInvoicePaid`, `invoiceDate`, `orderId`) VALUES (:invoiceIssued, :invoicePaid, :invoiceDate, :orderId)");
                $preparedStatement->bindValue(':invoiceIssued', $invoice->getisIssued());
                $preparedStatement->bindValue(':invoicePaid', $invoice->getisPaid());
                $preparedStatement->bindValue(':invoiceDate', $invoice->getDate());
                $preparedStatement->bindValue(':orderId', $invoice->getOrderId());
                $preparedStatement->execute();
                $conn = null;
            } catch (PDOException $e) {
                $conn = null;
                throw new Exception("Przepraszamy chwilowo mamy problemy z serwerem bazy danych. Proszę spróbować zarejestrować się za chwilę");
            }
        }
    }
}