<!DOCTYPE html>
<html>
<body>

<h2>Stead Fast Curier</h2>

<form action="{{ route('order.persel') }}" method="POST">
    @csrf
    <label for="fname">Invoice :</label><br>
    <input type="text" id="invoice" name="invoice"><br>
    <input type="hidden" id="consignment_id" name="consignment_id" value="1424107"><br><br>
    <label for="recipient_name">Recipient Name:</label><br>
    <input type="text" id="recipient_name" name="recipient_name"><br><br>
    <label for="recipient_phone">Recipient Phone Number:</label><br>
    <input type="text" id="recipient_phone" name="recipient_phone"><br><br>
    <label for="recipient_address">Recipient Address :</label><br>
    <textarea id="recipient_address" name="recipient_address" rows="3" cols="4"></textarea><br><br>
    <label for="cod_amount">Recipient Amount:</label><br>
    <input type="text" id="cod_amount" name="cod_amount"><br><br>
    <input type="hidden" id="status" name="status" value="in_review"><br><br>
    <input type="hidden" id="tracking_code" name="tracking_code" value="15BAEB8A"><br><br>
    <label for="note">Notes:</label><br>
    <textarea id="note" name="note" rows="5" cols="5"></textarea><br><br>
    <input type="submit" value="Submit">
</form>




</body>
</html>
