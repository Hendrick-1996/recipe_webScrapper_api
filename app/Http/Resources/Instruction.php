<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Instruction extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'step' => $this->step,
          'image' => $this->image,
          'text' => $this->text,
        ];
    }
}
// Column(
//           children: <Widget>[
//             Container(
// //                height: 300,
//                 child: Image.network(
//                   recipe.image,
//                   fit: BoxFit.cover,
//                 )),
//             Padding(
//               padding: EdgeInsets.only(top: 10.0 ,left: 10.0,right: 10.0),
//               child: Text(recipe.name,
//                   style: TextStyle(
//                     fontWeight: FontWeight.bold,
//                     fontSize: 25.0,
//                   )),
//             ),
//             Expanded(
//                 child:ListView(
//                   children: <Widget>[
//                     ListTile(
//                       leading: Icon(Icons.map),
//                       title: Text('Map'),
//                     ),
//                     ListTile(
//                       leading: Icon(Icons.photo_album),
//                       title: Text('Album'),
//                     ),
//                     ListTile(
//                       leading: Icon(Icons.phone),
//                       title: Text('Phone'),
//                     ),
//                   ],
//                 ),
//             ),
//           ],
//         )
