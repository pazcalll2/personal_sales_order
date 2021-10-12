<html>
	<head>
		<style>
			body {font-family: sans-serif;
				font-size: 10pt;
			}
			p {	margin: 0pt; }
			table.items {
				border: 0.1mm solid #000000;
			}
			td { vertical-align: top; }
			.items td {
				border-left: 0.1mm solid #000000;
				border-right: 0.1mm solid #000000;
			}
			table thead td { background-color: #EEEEEE;
				text-align: center;
				border: 0.1mm solid #000000;
				font-variant: small-caps;
			}
			.items td.blanktotal {
				background-color: #EEEEEE;
				border: 0.1mm solid #000000;
				background-color: #FFFFFF;
				border: 0mm none #000000;
				border-top: 0.1mm solid #000000;
				border-right: 0.1mm solid #000000;
			}
			.items td.totals {
				text-align: right;
				border: 0.1mm solid #000000;
			}
			.items td.cost {
				text-align: "." center;
			}
		</style>
	</head>
	<body>
		<table width="100%" style="font-family: sans;" cellpadding="10">
			<tr>
				<td width="45%" style="border: 0.1mm solid #888888; ">
					<span style="font-size: 7pt; color: #555555; font-family: sans;">
						DIKIRIM DARI:<span><br /><br />
					<span style="font-weight: bold; font-size: 14pt;">Gudang 1</span>
					<br />Jl. Mawar Melati Indah No. 234<br />Kota Layar<br />
					<span style="font-family:dejavusanscondensed;">&#9742;</span> +6289X-XXXX-XXXX
				</td>

				<td width="10%">&nbsp;</td>

				<td width="45%" style="border: 0.1mm solid #888888; ">
					<span style="font-size: 7pt; color: #555555; font-family: sans;">
						DITERIMA OLEH:<span><br /><br />
					<span style="font-weight: bold; font-size: 14pt;">{{$PurchaseOrder->po->user->name}}</span>
					<br />{{$PurchaseOrder->po->user->address}}<br/>
					<span style="font-family:dejavusanscondensed;">&#9742;</span>{{$PurchaseOrder->po->user->no_handphone}}
				</td>
			</tr>
		</table>

		<br />

		<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
			<thead>
				<tr>
				<td width="5%">No</td>
				<td width="55%">Deskripsi Barang</td>
				<td width="10%">Qty</td>
				<td width="20%">Harga Barang</td>
				<td width="20%">Subtotal</td>
				</tr>
			</thead>
			<tbody>
		<!-- ITEMS HERE -->
				@php
					$total = 0;
				@endphp
		<!-- @forelse ($PurchaseOrder->orders as $key => $item) -->
					
					($PurchaseOrder->orders as $key => $item)
					if($item->status = 'RETURN') {
						$item->tagihan_id => 'null';
					}
				@php
					$qty = $item->qty;
					$status = $item->status;
					$subtotal = $item->product->harga * $qty;
					if($status == 'RETURN') {
						$subtotal = '0';
					}
					$item->tagihan_id = 'null';
					$total += $subtotal;
				@endphp
				<tr>
					<td align="center">{{++$key}}</td>
					<td>{{$item->product->nama}}</td>
					<td align="center">{{$item->qty}}</td>
					<td align="right" class="cost">Rp {{number_format($item->product->harga,2,',','.')}}</td>
					<td align="right" class="cost">Rp {{number_format($subtotal,2,',','.')}}</td>
				</tr>
		<!-- @empty
		@endforelse -->
				<tr>
					<td class="totals" colspan="3"></td>
					<td align= "center" class="totals"><b>TOTAL:</b></td>
					<td class="totals cost"><b>Rp {{number_format($total,2,',','.')}}</b></td>
				</tr>
			</tbody>
		</table>
			<div style="text-align: center; font-style: italic;">Payment terms: payment due in 30 days</div>
	</body>
</html>
