<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Support\Str;
use App\Models\OrdersIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private function generatePdfContent($tickets)
    {
        $html = '<html><body>';
        $html .= '<h1>Liste des Tickets</h1>';

        foreach ($tickets as $ticket) {
            $html .= '<p>Ticket ID: ' . $ticket->ticket_id . '</p>';
            $html .= '<p>Descridtion: ' . $ticket->ticket_email . '</p>';
            $html .= '<hr>'; // Séparateur entre les tickets
        }

        $html .= '</body></html>';
        return $html;
    }

    /**
     * Génère les tickets au format PDF et retourne le lien de téléchargement.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateTickets($ticketIds)
    {
        // Récupérer les tickets
        $tickets = Ticket::whereIn('ticket_id', $ticketIds)->get();

        // Générer le contenu PDF
        $pdfContent = $this->generatePdfContent($tickets);

        // Utiliser Dompdf pour générer le PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($pdfContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nom du fichier PDF à générer
        $filename = 'tickets_' . time() . '.pdf';

        // Enregistrer le fichier PDF sur le serveur
        // Storage::disk('public')->put($filename, $dompdf->output());
        // $dompdf->output()->move('tickets', $filename);
        $filePath = public_path('tickets/'.$filename);
        file_put_contents($filePath, $dompdf->output());


        // Construire l'URL de téléchargement
        $fileUrl = asset('tickets/'.$filename);

        // Retourner l'URL du fichier
        return $fileUrl;

        // Retourner la réponse avec le fichier PDF
        // return response()->stream(function () use ($dompdf) {
        //     echo $dompdf->output();
        // }, 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        // ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_number' => 'required|string|max:50|unique:orders,order_number',
            'order_event_id' => 'required|integer',
            'order_payment' => 'required|string|max:100',
            'order_info' => 'nullable|string',
        ], [
            'order_number.required' => 'Le nombre de commande est obligatoire.',
            'order_number.string' => 'Le nombre de commande doit être une chaîne de caractères.',
            'order_number.max' => 'Le nombre de commande ne peut pas dépasser 50 caractères.',
            'order_number.unique' => 'Ce nombre de commande est déjà utilisé.',
            'order_event_id.required' => 'L\'identifiant d\'événement est obligatoire.',
            'order_event_id.integer' => 'L\'identifiant d\'événement doit être un entier.',
            'order_price.required' => 'Le prix est obligatoire.',
            'order_price.string' => 'Le prix doit être une chaîne de caractères.',
            'order_price.max' => 'Le prix ne peut pas dépasser 10 caractères.',
            'order_type.required' => 'Le type de commande est obligatoire.',
            'order_type.string' => 'Le type de commande doit être une chaîne de caractères.',
            'order_type.max' => 'Le type de commande ne peut pas dépasser 50 caractères.',
            'order_payment.required' => 'Le moyen de paiement est obligatoire.',
            'order_payment.string' => 'Le moyen de paiement doit être une chaîne de caractères.',
            'order_payment.max' => 'Le moyen de paiement ne peut pas dépasser 100 caractères.',
            'order_info.string' => 'Les informations supplémentaires doivent être une chaîne de caractères.',
            'order_created_on.date_format' => 'La date de création doit être au format YYYY-MM-DD HH:MM:SS.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        // Créer une nouvelle instance de OrdersIntent avec les données validées
        $orderIntent = OrdersIntent::where('order_intent_id',$request->order_intent_id)->firstOrFail();

        $order = Order::create([
            'order_number' => $request->order_number,
            'order_event_id' => $request->order_event_id,
            'order_price' => $orderIntent->order_intent_price,
            'order_type' => $orderIntent->order_intent_type,
            'order_payment' => $request->order_payment,
            'order_info' => $request->order_info,
            'order_created_on' => Carbon::now(),

            'user_id' => $request->user()->id,
        ]);

        $nombre = (int)$request->order_number;
        // Vérifier si le nombre est un entier positif
        if (!is_numeric($nombre) || $nombre <= 0) {
            return response()->json(['message' => 'Le nombre doit être un entier positif.'], 400);
        }

        $randomKey = strtoupper(Str::random(10));
        // s'assurer que la clé est unique
        $exists = Ticket::where('ticket_key', $randomKey)->exists();
        while ($exists) {
            $randomKey = strtoupper(Str::random(10));
        }

        $event = Event::find($order->order_event_id);

        $ticketType = TicketType::where('ticket_type_name', $order->order_type)->first();

        $tickets = [];

        // Boucle pour créer un ticket $nombre fois
        for ($i = 0; $i < $nombre; $i++) {
            $tickets[] = Ticket::create([
                'ticket_event_id' => $order->order_event_id,
                'ticket_email' => $orderIntent->user_email,
                'ticket_phone' => $orderIntent->user_phone,
                'ticket_price' => $ticketType->ticket_type_price,
                'ticket_order_id' => $order->order_id,
                'ticket_key' => $randomKey,
                'ticket_ticket_type_id' => $ticketType->ticket_type_id,
                'ticket_status' => 'active',
                'ticket_created_on' => Carbon::now()
            ]);
        }
        // return array_column($tickets, 'ticket_id');
        $url = $this->generateTickets(array_column($tickets, 'ticket_id'));
        // Retourne une réponse JSON en cas de succès
        return response()->json([
            'message' => 'Réservation confirmé avec succès.',
            'downloadUrl' => $url,
            'result' => [
                'Commande' => $order,
                'tickets' => $tickets
            ],
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $orders = Order::where('user_id', $userId)->paginate(4);

        return response()->json([
            'message' => 'Liste des commandes de l\'utilisateur',
            'result' => $orders,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($orderId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $orderId)
    {
        // return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($orderId)
    {
        //
    }
}
