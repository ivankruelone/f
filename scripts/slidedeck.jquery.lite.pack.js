/**
 * SlideDeck 1.2.5 Lite - 2011-06-01
 * Copyright (c) 2011 digital-telepathy (http://www.dtelepathy.com)
 * 
 * Support the developers by purchasing the Pro version at http://www.slidedeck.com/download
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * 
 * More information on this project:
 * http://www.slidedeck.com/
 * 
 * Requires: jQuery v1.3+
 * 
 * Full Usage Documentation: http://www.slidedeck.com/usage-documentation 
 * Usage:
 *     $(el).slidedeck(opts);
 * 
 * @param {HTMLObject} el    The <DL> element to extend as a SlideDeck
 * @param {Object} opts        An object to pass custom override options to
 */

eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('L 1P;L 4W={};(T($){3b.1P=T(p,q){L r=O,p=$(p);L u="1.2.5";O.N={1V:4k,1U:\'4E\',1T:1,1j:M,1c:M,1S:M,2s:M,2r:U,3p:4b,12:U,1D:U};O.S={24:\'24\',1Y:\'1Y\',3j:\'3j\',1c:\'1c\',1B:\'1B\',2N:\'2N\',1j:\'1j\',3m:\'3m\',4X:\'3y\',1X:\'1X\',1e:\'1e\'};O.W=1;O.2f=p;O.18=p.30(\'3x\');O.19=p.30(\'3M\');O.3U=1;O.3Z=[];O.43=[];O.1x=U;O.2e=U;L v=4o.4s.3d();O.Q={1F:v.X(/1F/)?M:U,1H:v.X(/1H/)?M:U,2Q:v.X(/1H\\/2/)?M:U,2J:v.X(/1H\\/3\\.0/)?M:U,17:v.X(/17/)?M:U,34:(v.X(/17 6/)&&!v.X(/17 7|8/))?M:U,4q:v.X(/17 7/)?M:U,4r:v.X(/17 8/)?M:U,1Q:v.X(/17 9/)?M:U,2B:(v.X(/17/)&&v.X(/1F/))?M:U,2b:v.X(/2b/)?M:U,29:(v.X(/29/)&&!v.X(/1F/))?M:U};1u(L b 1E O.Q){K(O.Q[b]===M){O.Q.41=b}}K(O.Q.1F===M&&!O.Q.2B){O.Q.1r=v.X(/1F\\/([0-9\\.]+)/)[1]}K(O.Q.1H===M){O.Q.1r=v.X(/1H\\/([0-9\\.]+)/)[1]}K(O.Q.17===M){O.Q.1r=v.X(/17 ([0-9\\.]+)/)[1]}K(O.Q.2b===M){O.Q.1r=v.X(/1r\\/([0-9\\.]+)/)[1]}K(O.Q.29===M){O.Q.1r=v.X(/1r\\/([0-9\\.]+)/)[1]}L w;L x;L y,1m,1t,1o;L z=T(a){K(r.Q.17&&!r.Q.1Q){L b=a.V(\'4F-2Y\');L c=b;K(c=="3s"){b="#3u"}1l{K(c.X(\'#\')){K(c.Y<7){L t="#"+c.1v(1,1)+c.1v(1,1)+c.1v(2,1)+c.1v(2,1)+c.1v(3,1)+c.1v(3,1);b=t}}}b=b.3Y("#","");1w={r:b.1v(0,2),g:b.1v(2,2),b:b.1v(4,2)};L d="#";L e="4i";1u(L k 1E 1w){1w[k]=1a.21(0,(1b(1w[k],16)-1));1w[k]=e.2z((1w[k]-1w[k]%16)/16)+e.2z(1w[k]%16);d+=1w[k]}a.26(\'.\'+r.S.1c).V({\'2D\':\'2E:2F.2H.2I(25=1) 3v(2Y=\'+d+\')\',3w:d})}};L A={1C:"3E"+(1a.2h(1a.2Z()*3X)),2j:"1y:1J !1k;14:"+13+"P !1k;Z:"+2y+"P !1k;2l:2p !1k;2C:0 !1k;2w:2d !1k;4v:4A !1k;4D:1 !1k;1q:0 !1k;z-1c:2G !1k",Z:2y,14:13};L B=T(){K(!1g.3q(A.1C)){L a=1g.1N(\'A\');a.1C=A.1C;a.3t="2K://2L.1I.2P/?53=3z&3A=3B&3C=3D";a.2R="3G";L b=1g.1N(\'3H\');b.3J=(1g.3K.3L=="2T:"?"2T:":"2K:")+"//2L.1I.2P/3N/"+u+"/3O";b.3P="3T 2X 1P&3V;";b.Z=A.Z;b.14=A.14;b.1O="0";a.2q(b);A.11=(p.1i().11+p.14()+5);A.R=p.1i().R+p.Z()-A.Z;L s=1g.1N(\'44\');s.45="48/V";L c=\'#\'+A.1C+\'{11:\'+A.11+\'P;R:\'+A.R+\'P;\'+A.2j+\'}\'+\'#\'+A.1C+\' 49{11:0 !1k;R:0 !1k;\'+A.2j+\'}\';K(s.3a){s.3a.4h=c}1l{s.2q(1g.3c(c))}$(\'4j\').2c(s);K(1a.2Z()<0.5){$(1g.3f).4l(a)}1l{$(1g.3f).2c(a)}$(3b).4m(T(){B()})}A.11=(p.1i().11+p.14()+5);A.R=p.1i().R+p.Z()-A.Z;$(\'#\'+A.1C).V({11:A.11+"P",R:A.R+"P"})};L C=T(){3g=T(){K(r.1x===U){K(r.N.1D===U&&r.W==r.19.Y){r.1x=M}1l{r.1e()}}};3i(3g,r.N.3p)};L D=T(){K($.3k(p.V(\'1y\'),[\'1y\',\'1J\',\'4t\'])){p.V(\'1y\',\'4u\')}p.V(\'2w\',\'2d\');1u(L i=0;i<r.19.Y;i++){L d=$(r.19[i]);K(r.18.Y>i){L e=$(r.18[i])}L f={11:1b(d.V(\'1q-11\'),10),1f:1b(d.V(\'1q-1f\'),10),1p:1b(d.V(\'1q-1p\'),10),R:1b(d.V(\'1q-R\'),10)};L g={11:1b(d.V(\'1O-11-Z\'),10),1f:1b(d.V(\'1O-1f-Z\'),10),1p:1b(d.V(\'1O-1p-Z\'),10),R:1b(d.V(\'1O-R-Z\'),10)};1u(L k 1E g){g[k]=2A(g[k])?0:g[k]}K(i<r.W){K(i==r.W-1){K(r.N.12!==M){e.1d(r.S.1B)}d.1d(r.S.1B)}1i=i*1m;K(r.N.12===M){K(i==r.W-1){1i=0}1l{1i=0-(r.N.1T-i-1)*p.Z()}}}1l{1i=i*1m+1t;K(r.N.12===M){1i=(i+1-r.N.1T)*p.Z()}}r.1t=(1t-f.R-f.1f-g.R-g.1f);d.V({1y:\'1J\',R:1i,28:1,14:(x-f.11-f.1p-g.11-g.1p)+"P",Z:r.1t+"P",2C:0,3r:f.R+1m+"P"}).1d(r.S.24).1d(r.S.24+"2o"+(i+1));K(r.N.12!==M){L h={11:1b(e.V(\'1q-11\'),10),1f:1b(e.V(\'1q-1f\'),10),1p:1b(e.V(\'1q-1p\'),10),R:1b(e.V(\'1q-R\'),10)};1u(L k 1E h){K(h[k]<10&&(k=="R"||k=="1f")){h[k]=10}}L j=h.11+"P "+h.1f+"P "+h.1p+"P "+h.R+"P";L l={1y:\'1J\',28:3,2l:\'2p\',R:1i,Z:(x-h.R-h.1f)+"P",14:y+"P",1q:j,25:\'1Z\',\'-22-1h\':\'1z(1Z)\',\'-22-1h-1K\':1o+\'P 1G\',\'-23-1h\':\'1z(1Z)\',\'-23-1h-1K\':1o+\'P 1G\',\'-o-1h\':\'1z(1Z)\',\'-o-1h-1K\':1o+\'P 1G\',2M:\'1f\'};K(!r.Q.1Q){l.11=(r.Q.17)?0:(x-1o)+"P";l.3F=((r.Q.17)?0:(0-1o))+"P";l.2D=\'2E:2F.2H.2I(25=3)\'}e.V(l).1d(r.S.1Y).1d(r.S.1Y+"2o"+(i+1));K(r.Q.1Q){e[0].1M.2O=\'1z(1Z)\';e[0].1M.3I=1a.2h(1b(p[0].1M.14)/2)+\'P \'+1a.2h(1b(p[0].1M.14)/2)+\'P\'}}1l{K(1n(e)!="27"){e.2g()}}K(i==r.19.Y-1){d.1d(\'2S\');K(r.N.12!==M){e.1d(\'2S\')}}K(r.N.1j===M&&r.N.12===U){L m=1g.1N(\'2U\');m.2V=r.S.1j+\' \'+(r.S.1Y+\'2o\'+(i+1));e.3Q(m);e.1e(\'.\'+r.S.1j).V({1y:\'1J\',11:\'3R\',R:1i+1m+"P",2w:"2d",28:"2G"}).2g();K(e.3S(r.S.1B)){e.1e(\'.\'+r.S.1j).2W()}}K(r.N.12!==M){L n=1g.1N(\'2U\');n.2V=r.S.1c;K(r.N.1c!==U){L o;K(1n(r.N.1c)!=\'2i\'){o=r.N.1c[i%r.N.1c.Y]}1l{o=""+(i+1)}n.2q(1g.3c(o))}e.2c(n);e.26(\'.\'+r.S.1c).V({1y:\'1J\',28:2,2l:\'2p\',Z:y+"P",14:y+"P",2M:\'3W\',1p:((r.Q.17)?0:(0-1o))+"P",R:((r.Q.17)?5:20)+"P",25:"1L",\'-22-1h\':\'1z(1L)\',\'-22-1h-1K\':1o+\'P 1G\',\'-23-1h\':\'1z(1L)\',\'-23-1h-1K\':1o+\'P 1G\',\'-o-1h\':\'1z(1L)\',\'-o-1h-1K\':1o+\'P 1G\'});K(r.Q.1Q){e.26(\'.\'+r.S.1c)[0].1M.2O=\'1z(1L)\'}z(e)}}B();K(r.N.12!==M){r.18.2k(\'40\',T(a){a.1R();r.31(r.18.1c(O)+1)})}K(r.N.2s!==U){$(1g).2k(\'42\',T(a){K($(a.2R).32().1c(r.2f)==-1){K(a.33==39){r.1x=M;r.1e()}1l K(a.33==37){r.1x=M;r.2m()}}})}K(1n($.46.47.35)!="27"){p.2k("35",T(a){K(r.N.1S!==U){L b=a.36?a.36:a.4a;K(r.Q.17||r.Q.29||r.Q.1F){b=0-b}L c=U;K($(a.38).32(r.2f).Y){K($.3k(a.38.4c.3d(),[\'4d\',\'4e\',\'4f\',\'4g\'])!=-1){c=M}}K(c!==M){K(b>0){2n(r.N.1S){15"1W":a.1R();1s;15 M:3e:K(r.W<r.19.Y||r.N.1D==M){a.1R()}1s}r.1x=M;r.1e()}1l{2n(r.N.1S){15"1W":a.1R();1s;15 M:3e:K(r.W!=1||r.N.1D==M){a.1R()}1s}r.1x=M;r.2m()}}}})}$(r.18[r.W-2]).1d(r.S.1X);$(r.18[r.W]).1d(r.S.1e);K(r.N.2r===M){C()}r.2e=M};L E=T(a){a=1a.2a(r.19.Y,1a.21(1,a));1A a};L F=T(a,b){a=E(a);L c=M;K(a<r.W){c=U}L d=[r.S.1B,r.S.1e,r.S.1X].4p(\' \');r.W=a;r.18.3h(d);r.19.3h(d);p.26(\'.\'+r.S.1j).2g();$(r.18[r.W-2]).1d(r.S.1X);$(r.18[r.W]).1d(r.S.1e);1u(L i=0;i<r.19.Y;i++){L e=0;K(r.N.12!==M){L f=$(r.18[i])}L g=$(r.19[i]);K(i<r.W){K(i==(r.W-1)){g.1d(r.S.1B);K(r.N.12!==M){f.1d(r.S.1B);f.1e(\'.\'+r.S.1j).2W()}}e=i*1m}1l{e=i*1m+1t}K(r.N.12===M){e=(i-r.W+1)*p.Z()}L h={2t:r.N.1V,2u:r.N.1U};g.1W().2v({R:e+"P",Z:r.1t+"P"},h);K(r.N.12!==M){z(f);K(f.V(\'R\')!=e+"P"){f.1W().2v({R:e+"P"},{2t:r.N.1V,2u:r.N.1U});f.1e(\'.\'+r.S.1j).1W().2v({R:e+1m+"P"},{2t:r.N.1V,2u:r.N.1U})}}}B()};L G=T(a,b){L c=a;K(1n(a)==="3l"){c={};c[a]=b}1u(L d 1E c){b=c[d];2n(d){15"1V":15"1T":b=4w(b);K(2A(b)){b=r.N[d]}1s;15"1S":15"2s":15"1j":15"12":15"2r":15"1D":K(1n(b)!=="2i"){b=r.N[d]}1s;15"1U":K(1n(b)!=="3l"){b=r.N[d]}1s;15"4x":15"4y":K(1n(b)!=="T"){b=r.N[d]}1s;15"1c":K(1n(b)!=="2i"){K(!$.4z(b)){b=r.N[d]}}1s}r.N[d]=b}};L H=T(){x=p.14();w=p.Z();p.V(\'14\',x+"P");y=0;1m=0;K(r.N.12!==M&&r.18.Y>0){y=$(r.18[0]).14();1m=$(r.18[0]).4B()}1t=w-1m*r.18.Y;K(r.N.12===M){1t=w}1o=1a.4C(y/2)};L I=T(a){K((r.Q.2b&&r.Q.1r<"10.5")||r.Q.34||r.Q.2Q||r.Q.2J){K(1n(2x)!="27"){K(1n(2x.3n)=="T"){2x.3n("4G 4H Q 4I 4J 4K 2X 1P. 4L 4M O 4N 1E a 4O, 4P 4Q Q 4R a W 1r 4S 4T 4U")}}1A U}K(1n(a)!="27"){1u(L b 1E a){r.N[b]=a[b]}}K(r.18.Y<1){r.N.12=M}K(r.N.12===M){r.N.1j=U}r.W=1a.2a(r.19.Y,1a.21(1,r.N.1T));K(p.14()>0){H();D()}1l{L c;c=4V(T(){H();K(p.14()>0){3o(c);H();D()}},20)}};L J=T(a){L b;b=3i(T(){K(r.2e==M){3o(b);a()}},20)};O.4Y=T(a){J(a);1A r};O.1e=T(a){L b=1a.2a(r.19.Y,(r.W+1));K(r.N.1D===M){K(r.W+1>r.19.Y){b=1}}F(b,a);1A r};O.2m=T(a){L b=1a.21(1,(r.W-1));K(r.N.1D===M){K(r.W-1<1){b=r.19.Y}}F(b,a);1A r};O.31=T(a,b){r.1x=M;F(1a.2a(r.19.Y,1a.21(1,a)),b);1A r};O.4Z=T(a,b){G(a,b);1A r};I(q)};$.50.1I=T(a){L b=[];1u(L i=0;i<O.Y;i++){K(!O[i].1I){O[i].1I=51 1P(O[i],a)}b.52(O[i].1I)}1A b.Y>1?b:b[0]}})(4n);',62,314,'||||||||||||||||||||||||||||||||||||||||||||||if|var|true|options|this|px|browser|left|classes|function|false|css|current|match|length|width||top|hideSpines||height|case||msie|spines|slides|Math|parseInt|index|addClass|next|right|document|transform|offset|activeCorner|important|else|spine_outer_width|typeof|spine_half_width|bottom|padding|version|break|slide_width|for|substr|cParts|pauseAutoPlay|position|rotate|return|active|id|cycle|in|chrome|0px|firefox|slidedeck|absolute|origin|90deg|style|createElement|border|SlideDeck|msie9|preventDefault|scroll|start|transition|speed|stop|previous|spine|270deg||max|webkit|moz|slide|rotation|find|undefined|zIndex|safari|min|opera|append|hidden|isLoaded|deck|hide|round|boolean|styles|bind|display|prev|switch|_|block|appendChild|autoPlay|keys|duration|easing|animate|overflow|console|130|charAt|isNaN|chromeFrame|margin|filter|progid|DXImageTransform|20000|Microsoft|BasicImage|firefox30|http|www|textAlign|indicator|msTransform|com|firefox2|target|last|https|DIV|className|show|by|color|random|children|goTo|parents|keyCode|msie6|mousewheel|detail||originalTarget||styleSheet|window|createTextNode|toLowerCase|default|body|gotoNext|removeClass|setInterval|label|inArray|string|disabled|error|clearInterval|autoPlayInterval|getElementById|paddingLeft|transparent|href|ffffff|chroma|backgroundColor|dt|slidesVertical|LiteUser|utm_medium|Link|utm_campaign|SDbug|SlideDeck_Bug|marginLeft|_blank|IMG|msTransformOrigin|src|location|protocol|dd|6885858486f31043e5839c735d99457f045affd0|lite|alt|after|25px|hasClass|Powered|controlTo|trade|center|100000000|replace|session|click|_this|keydown|disabledSlides|STYLE|type|event|special|text|img|wheelDelta|5000|nodeName|input|select|option|textarea|cssText|01234567890ABCDEF|head|500|prepend|resize|jQuery|navigator|join|msie7|msie8|userAgent|fixed|relative|visibility|parseFloat|complete|before|isArray|visible|outerHeight|ceil|opacity|swing|background|This|web|is|not|supported|Please|view|page|modern|CSS3|capable|or|of|Inernet|Explorer|setTimeout|SlideDeckSkin|vertical|loaded|setOption|fn|new|push|utm_source'.split('|'),0,{}))