// JavaScript Document



function getQuestions(){
  var questions = [
    {q:"沪尚茗居目前在上海有几家店？",choose:["2家","3家","4家"],result:"2",fontSize:"20px",index:0},
    {q:"沪尚茗居的旗舰店是哪家店？",choose:["闵行店","松江店","嘉定店"],result:"1",fontSize:"20px",index:1},
    {q:"沪尚茗居装修包含哪些项目？",choose:["包设计 包主材 包施工 包家具 包灯具","包水电 包家具 包辅材 包灯具 包厨具","包主材 包水电 包灯具 包家电 包衣柜"],result:"1",fontSize:"14px",index:2},
    {q:"沪尚茗居的装修模式是什么？",choose:["半包装修+实景体验","全屋装修+实景体验","一站式全屋整装+实景体验"],result:"3",fontSize:"14px",index:3},
    {q:"沪尚茗居的服务理念是什么？",choose:["全心全意为家服务","创享崭新生活","沪尚茗居开启整装大时代"],result:"1",fontSize:"14px",index:4},
    {q:"沪尚茗居的企业使命是什么？",choose:["全心全意为家服务","创享崭新生活","沪尚茗居开启整装大时代"],result:"2",fontSize:"14px",index:5},
    {q:"沪尚茗居家装工厂的总部在哪里？",choose:["上海市松江区方塔北路558弄6号","上海市闵行区颛兴东路1280弄5号","上海市嘉定区曹安公路2883号11栋"],result:"2",fontSize:"14px",index:6},
    {q:"沪尚茗居城市精英概念店在哪里？",choose:["上海市松江区方塔北路558弄6号","上海市闵行区颛兴东路1280弄5号","上海市嘉定区曹安公路2883号11栋"],result:"3",fontSize:"14px",index:7},
    {q:"家装施工工长有几种？",choose:["瓦工","电工","瓦工、电工、木工"],result:"3",fontSize:"18px",index:8},
    {q:"家庭装修施工分几个阶段？",choose:["土建阶段","基础处理阶段","土建阶段，基层处理阶段，细节处理阶段"],result:"3",fontSize:"14px",index:9},
    {q:"旧房改造有哪些重点？",choose:["对门窗加以改造","对旧房墙、顶面的改造","以上两项都对"],result:"3",fontSize:"14px",index:10},
  ];
  
  var q = new Array();
  
  while(q.length < 3){
    var index = Math.ceil(Math.random()/(1/questions.length)) - 1;
    q.push(questions[index]);
    questions.splice(index, 1);
  }
  return q;
}