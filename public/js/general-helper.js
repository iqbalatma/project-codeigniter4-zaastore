function intToRupiah(number) {
  let rupiah = "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  return rupiah;
}

function rupiahToInt(rupiah) {
  let rupiahInt = rupiah.split(" ");
  rupiahInt = rupiahInt[1];
  rupiahInt = rupiahInt.replaceAll(".", "");
  rupiahInt = parseInt(rupiahInt);
  return rupiahInt;
}

function getStatusName(idStatus) {
  let status = [
    "Desain Selesai",
    "Produksi Selesai",
    "Packing Selesai",
    "Checkout Selesai",
    "Waiting List",
  ];
  return status[parseInt(idStatus) - 1];
}
