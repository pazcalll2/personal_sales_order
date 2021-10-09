@php
	use App\Http\Controllers\Helper;
@endphp
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


<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
	<td width="5%">No</td>
	<td width="55%">Deskripsi Barang</td>
	<td width="10%">Qty</td>
	<td width="20%">Harga Barang</td>
	<td width="20%">Keterangan</td>
</tr>
</thead>
<tbody>

@forelse ($PurchaseOrder->orders as $key => $item)
	<tr>
		<td align="center">{{++$key}}</td>
		<td>{{$item->product->nama}}</td>
		<td align="center">{{$item->qty}}</td>
		<td align="right" class="cost">Rp. {{number_format($item->product->harga,2,',','.')}}</td>
		<td align="right" class="cost"></td>
	</tr>
@empty
@endforelse
</tbody>
</table>

<div style="margin-top:5px;font-size: 8pt;text-align: right">Kediri, {{Helper::tgl_full(date('Y-m-d'),1)}}</div>

<table style="font-size: 8pt; margin-top:15px;">
	<tr>
		<td width="20%" align="center">Penerima :</td>
		<td width="20%"></td>
		<td width="20%" align="center">Pengirim :</td>
		<td width="20%"></td>
		<td width="20%" align="center">Mengetahui :</td>
	</tr>
	<tr>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" align="center">(...................................................)</td>
		<td width="20%"></td>
		<td width="20%" align="center">(...................................................)</td>
		<td width="20%"></td>
		<td width="20%" align="center">(...................................................)</td>
	</tr>
</table>
</body>
</html>
