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
            $html .= '<p>Description: ' . $ticket->ticket_email . '</p>';
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
        // Créer une nouvelle instance de OrdersIntent avec les données validées
        $orderIntent = OrdersIntent::where('order_intent_id',$request->order_intent_id)->firstOrFail();

        $order = Order::create([
            'order_number' => $request->order_number,
            'order_event_id' => $request->order_event_id,
            'order_price' => $orderIntent->order_intent_price,
            'order_type' => $orderIntent->order_intent_type,
            'order_payment' => $request->order_payment,
            'order_info' => $request->order_info,
            'order_created_on' => Carbon::now()
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
            'data' => [
                'Commande' => $order,
                'tickets' => $tickets
            ],
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($orderId)
    {
        //
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
