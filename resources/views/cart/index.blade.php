<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier — Boutique</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #0A0A0A; color: #E8E8E8; font-family: system-ui, sans-serif; }
        nav { background: #111; border-bottom: 1px solid #1f1f1f; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        nav .logo { color: #F97316; font-size: 1.2rem; font-weight: 700; }
        nav .links a { color: #888; text-decoration: none; margin-left: 1.5rem; font-size: 0.9rem; }
        .container { max-width: 800px; margin: 3rem auto; padding: 0 2rem; }
        h1 { font-size: 1.8rem; margin-bottom: 2rem; }
        .item { background: #111; border: 1px solid #1f1f1f; border-radius: 10px; padding: 1.25rem; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center; }
        .item-name { font-weight: 500; margin-bottom: 4px; }
        .item-price { color: #F97316; font-size: 0.9rem; }
        .total { background: #111; border: 1px solid #F9731640; border-radius: 10px; padding: 1.25rem; margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; }
        .btn { background: #F97316; color: #fff; border: none; padding: 12px 24px; border-radius: 6px; cursor: pointer; font-size: 0.9rem; }
        .btn-danger { background: transparent; border: 1px solid #EF444440; color: #EF4444; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.75rem; }
        .empty { text-align: center; padding: 4rem; color: #444; }
    </style>
</head>
<body>
    <nav>
        <span class="logo">PS. Boutique</span>
        <div class="links">
            <a href="{{ route('products.index') }}">Produits</a>
            <a href="{{ route('cart.index') }}" style="color:#F97316">🛒 Panier</a>
        </div>
    </nav>

    <div class="container">
        <h1>Mon Panier</h1>

        @if(count($cart) > 0)
            @foreach($cart as $id => $item)
            <div class="item">
                <div>
                    <div class="item-name">{{ $item['name'] }}</div>
                    <div class="item-price">{{ number_format($item['price'], 0, ',', ' ') }} FCFA × {{ $item['quantity'] }}</div>
                </div>
                <form method="POST" action="{{ route('cart.remove', $id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Retirer</button>
                </form>
            </div>
            @endforeach

            <div class="total">
                <span style="font-size:1.1rem">Total</span>
                <span style="color:#F97316;font-size:1.3rem;font-weight:700">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
            </div>

            <form method="POST" action="{{ route('cart.checkout') }}" style="margin-top:1.5rem">
                @csrf
                <button type="submit" class="btn">Valider la commande →</button>
            </form>
        @else
            <div class="empty">
                <p style="font-size:1.1rem;margin-bottom:1rem">Votre panier est vide</p>
                <a href="{{ route('products.index') }}" style="color:#F97316;text-decoration:none">← Voir les produits</a>
            </div>
        @endif
    </div>
</body>
</html>