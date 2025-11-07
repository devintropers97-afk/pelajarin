-- ========================================
-- SITUNEO DIGITAL - Payment Methods Seed Data
-- ========================================

INSERT INTO `payment_methods` (`method_name`, `method_type`, `bank_name`, `account_number`, `account_name`, `instructions`, `active`, `order`) VALUES
('Transfer Bank BCA', 'bank_transfer', 'Bank Central Asia (BCA)', '1234567890', 'PT PERMATA CAHAYA ABADI', 'Transfer ke rekening BCA dengan nominal sesuai invoice. Upload bukti transfer setelah pembayaran.', 1, 1),
('Transfer Bank Mandiri', 'bank_transfer', 'Bank Mandiri', '9876543210', 'PT PERMATA CAHAYA ABADI', 'Transfer ke rekening Mandiri dengan nominal sesuai invoice. Konfirmasi pembayaran via WhatsApp.', 1, 2),
('Transfer Bank BNI', 'bank_transfer', 'Bank Negara Indonesia (BNI)', '5555444433', 'PT PERMATA CAHAYA ABADI', 'Transfer ke rekening BNI. Sertakan kode unik jika ada.', 1, 3),
('GoPay / QRIS', 'ewallet', NULL, NULL, NULL, 'Scan QRIS code yang diberikan admin. Nominal harus sesuai invoice.', 1, 4),
('OVO', 'ewallet', NULL, '0831-7386-8915', 'Devin Prasetyo', 'Transfer ke nomor OVO. Screenshot bukti pembayaran diperlukan.', 1, 5);
