<x-mail::message>
# Order Placed Berhasil

Terimakasih telah melakukan order. Nomor Order Kamu adalah: {{ $order->id }}

<x-mail::button :url="$url">
Lihat Order
</x-mail::button>

Thanks,<br>
Munir Jaya Abadi
</x-mail::message>
