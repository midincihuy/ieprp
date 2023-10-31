<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Ticket;
use Validator;
use App\Http\Resources\TicketResource;
use Illuminate\Http\JsonResponse;
   
class TicketController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $tickets = Ticket::all();
    
        return $this->sendResponse(TicketResource::collection($tickets), 'Tickets retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'msg_id' => 'required',
            'ticket_number' => 'required',
            'phone_number' => 'required',
            'start_time' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $ticket = Ticket::create($input);
   
        return $this->sendResponse(new TicketResource($ticket), 'Ticket created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $ticket = Ticket::find($id);
  
        if (is_null($ticket)) {
            return $this->sendError('Ticket not found.');
        }
   
        return $this->sendResponse(new TicketResource($ticket), 'Ticket retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket): JsonResponse
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'msg_id' => 'required',
            'ticket_number' => 'required',
            'phone_number' => 'required',
            'start_time' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $ticket->fill($request->all());
        $ticket->save();
   
        return $this->sendResponse(new TicketResource($ticket), 'Ticket updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket): JsonResponse
    {
        $ticket->delete();
   
        return $this->sendResponse([], 'Ticket deleted successfully.');
    }
}