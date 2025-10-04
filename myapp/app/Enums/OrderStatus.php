<?php
namespace App\Enums;

enum OrderStatus: string {
  case Pending = 'Pending';
  case Paid = 'Paid';
  case Shipped = 'shipped';
  case Delivered = 'delivered';
  case Canseled = 'canseled';
}
