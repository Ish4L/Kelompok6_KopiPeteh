<div class="modal-overlay" id="orderDetailModal">
    <div class="modal-content">
        <form action="" method="POST" class="order-form" id="orderStatusForm">
            @csrf
            @method('PUT')

            <div class="modal-body detail-order">
                <h1>Detail Pesanan</h1>
                <p class="order-subtitle" id="modalOrderNumber">Pesanan #000</p>
                <hr>

                <div class="order-section">
                    <h4>Detail Pesanan</h4>
                    <div class="detail-row">
                        <span>Nama Pelanggan</span>
                        <span class="detail-value" id="modalCustomerName">-</span>
                    </div>
                    <div class="detail-row">
                        <span>Nomor Telepon</span>
                        <span class="detail-value" id="modalCustomerPhone">-</span>
                    </div>
                    <div class="detail-row">
                        <span>Tanggal</span>
                        <span class="detail-value" id="modalOrderDate">-</span>
                    </div>
                    <div class="detail-row">
                        <span>Waktu</span>
                        <span class="detail-value" id="modalOrderTime">-</span>
                    </div>
                    <div class="detail-row">
                        <span>Metode Pembayaran</span>
                        <span class="detail-value" id="modalPaymentMethod">-</span>
                    </div>
                </div>

                <div class="order-section">
                    <h4>Detail Produk</h4>
                    <div id="modalOrderItems"></div>
                </div>

                <hr>

                <div class="detail-row total-row">
                    <span>Total</span>
                    <span class="detail-value" id="modalTotalPrice">Rp 0</span>
                </div>

                <div class="input-box">
                    <label for="modalOrderStatus">Status</label>
                    <select name="status" id="modalOrderStatus" required>
                        <option value="belum bayar">Belum bayar</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-batal" id="btnCloseOrderModal">Batal</button>
                <button type="submit" class="btn-simpan">Simpan</button>
            </div>
        </form>
    </div>
</div>